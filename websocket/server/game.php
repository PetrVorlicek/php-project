<?php
// GAME HANDLER - SERVER GAME LOGIC
function connectDB() {
    // TODO import from some shared space
    // connection to DB
    $dbHostname = "db";
    $dbname = "postgres";
    $dbUsername = "postgres";
    $dbPassword = "password";

    $dsn = "pgsql:host=$dbHostname;dbname=$dbname";
    $db = new PDO($dsn, $dbUsername, $dbPassword);
    return $db;
}

// TODO add type annotations
class Player {
    public string $name;
    public int $points;

    public function __construct($name, $points = 0) {
        // TODO rather than using name use ID from DB
        $this->name = $name;
        $this->points = $points;
    }
}

class Message {
    public string $command;
    public $payload;

    public function __construct($command, $payload) {
        $this->command = $command;
        $this->payload = $payload;
    }
}

class Question {
    private $used;
    private $question;
    private $rigthAnswer;
    private $wrongAnswers;
    public function __construct($categoryID, $pointsID) {
        // This question has not been used yet
        $this->used = false;
        // Get question and answers from database
        $db = connectDB();

        // Prepare queries
        $questionQuery = $db->prepare("SELECT question 
                                       FROM question
                                       WHERE category_id = :categoryID
                                       AND point_category_id = :pointsID;");
        
        $rightAnswerQuery = $db->prepare("SELECT answer_text 
                                          FROM answer
                                          JOIN question on answer.id = question.r_answer_id
                                          WHERE question.category_id = :categoryID
                                          AND question.point_category_id = :pointsID;");

        $wrongAnswersQuery = $db->prepare("SELECT answer_text
                                           FROM answer
                                           JOIN question on answer.id = question.r_answer_id
                                           WHERE question.category_id = :categoryID
                                           AND question.point_category_id != :pointsID
                                           ORDER BY RANDOM()
                                           LIMIT 3;");
        // Execute queries
        $questionQuery->execute(["categoryID" => $categoryID,"pointsID"=> $pointsID]);
        $rightAnswerQuery->execute(["categoryID" => $categoryID,"pointsID"=> $pointsID]);
        $wrongAnswersQuery->execute(["categoryID" => $categoryID,"pointsID"=> $pointsID]);

        // Load data
        $questionData = $questionQuery->fetch(PDO::FETCH_ASSOC);
        $rigthAnswerData = $rightAnswerQuery->fetch(PDO::FETCH_ASSOC);
        $wrongAnswersData = $wrongAnswersQuery->fetch(PDO::FETCH_ASSOC);

        $this->question = $questionData[0]["question"];
        $this->rigthAnswer = $rigthAnswerData[0]["answer_text"];
        $this->wrongAnswers = array_column($wrongAnswersData, "answer_text");

        // Close db connection
        $db = null;
    }

    public function getQuestion() {
        // Return shuffled answers, so it does not depend on position.
        $allAnswers = [...$this->wrongAnswers, $this->rigthAnswer];
        shuffle($allAnswers);
        // Returns a flat array with question as first index
        return [$this->question, ...$allAnswers];
    }

    public function evalQuestion($userAnswer) {
        if ($this->used) {
            // You don"t get points for answering twice!
            return 0;
        } 
        $this->used = true;
        if ($this->rigthAnswer===$userAnswer) {
            // Return a point!
            return 1;
        }
        return 0;
    }
}

class QuestionCategory {
    /** @var Question[] */
    private array $questions;
    private static $points; // [id -> point_value]
    public static function loadPoints() {
        // Connect to the DB
        $db = connectDB();

        // Load points to the pointValues array
        $query = $db->query("SELECT id, point_value 
                             FROM point_category 
                             ORDER BY point_value ASC");
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        $points = array();
        foreach ($data as $row) {
            $points[$row["id"]] = $row["point_value"];
        }
        QuestionCategory::$points = $points;

        // Disconnect DB
        $db = null;
    }
    public function __construct($categoryName) {
        // Connect DB
        $db = connectDB();

        // Get category ID
        $categoryIDQuery = $db->prepare('SELECT id 
                                         FROM category 
                                         WHERE category.name = :categoryName');
        $categoryIDQuery->execute(['categoryName'=> $categoryName]);
        $categoryIDData = $categoryIDQuery->fetch(PDO::FETCH_ASSOC);
        $categoryID = array_column($categoryIDData, 'id');

        // Create dict of questions
        foreach (QuestionCategory::$points as $point) {
            $this->questions[$point["id"]] = new Question($categoryID, $point["id"]);
        }

        // Disconnect DB
        $db = null;
    }
    public function getQuestion($pointID) {
        if (!isset($this->questions[$pointID])) {
            return $this->questions[$pointID]->getQuestion();
         }
    }
    public function answerQuestion($pointID, $userAnswer) {
        // Returns the points the user gets for his answer
        if (!isset($this->questions[$pointID])) {
            $answer = $this->questions[$pointID]->evalQuestion($userAnswer);
            return $answer * QuestionCategory::$points[$pointID];
        }
    }
}

class Game {
    // Class handling the game state
    /** @var QuestionCategory[] */
    private array $categories;
    /** @var Player[] */
    private array $players;
    /** @var array<array<string, string>> */ 
    private array $usedQuestions = [];
    private int $onTurn;
    private int $turnsRemaining;
    public function __construct(Player $player1, Player $player2, int $turnsRemaining = 0) {
        
        $db = connectDB();
        QuestionCategory::loadPoints();

        // Load category names and categories
        $categoryNameQuery = $db->query("SELECT name FROM category");
        $categoryNameData = $categoryNameQuery->fetch(PDO::FETCH_ASSOC);
        $categoryNames = array_column($categoryNameData,"name");
        foreach ($categoryNames as $categoryName) {
            $this->categories[$categoryName] = new QuestionCategory($categoryName);
        }

        // Save players for later use
        $this->players = array($player1, $player2);
        $this->onTurn = 0;

        // Save turns remaining
        // TODO: defaultly load from DB
        if ($turnsRemaining === 0) {
            $turnsRemaining = 25;
        }
        $this->turnsRemaining = $turnsRemaining;

        $db = null;
    }

    private function &switchTurn() {
        // Returns the player ref on turn and switches who is on turn next
        $player = $this->players[$this->onTurn];
        $this->onTurn = $this->onTurn ===0 ? 1 : 0;
        $this->turnsRemaining -= 1;
        return $player;
    }

    public function handleQuestion($categoryName,$pointsID) {
        if(isset($this->categories[$categoryName])) {
            return $this->categories[$categoryName]->getQuestion($pointsID);
        }
    }

    public function handleAnswer(string $categoryName, string $pointsID, string $userAnswer) {
        // Returns true if question was succesfull, false othervise
        if ($this->turnsRemaining <= 0) return false;

        if(isset($this->categories[$categoryName])) {
            // Get player
            $player = &$this->switchTurn();

            // Get points for answer
            $points = $this->categories[$categoryName]->answerQuestion($pointsID, $userAnswer);
            
            // Add points to the player
            $player->points += $points;

            // Add this question to used questions
            $this->usedQuestions[] = [$categoryName, $pointsID];

            return $points > 0;
        }
        return false;
    }

    public function getPlayerOnTurn() {
        // Returns name of the player on turn
        return $this->players[$this->onTurn]->name;
    }

    public function getPlayerPoints($playerName) {
        // Returns the points of the player with specified name
        $player = array_filter($this->players, function($player) use ($playerName) {
            return $player->name === $playerName;
        })[0];
        return $player ? $player->points : 0;
    }

    public function getPlayers() {
        return $this->players;
    }

    public function getUsedQuestions() {
        return $this->usedQuestions;
    }

    public function getOtherPlayer($playerName) {
        // Returns the name of the other player
        $player = array_filter($this->players, function($player) use ($playerName) {    
            return $player->name !== $playerName;
        })[0];
        return $player->name;
    }

    // TODO is this useful?
    public function isOver() {
        return $this->turnsRemaining > 0;
    }
}

// TODO players are random now, add loading and saving from DB
class GameHandler {
    // Class handling the message interactions
    private Game $game;
    /** @var string[] */
    private array $commands = ["getQuestion","answerQuestion","getState"];

    public function __construct(Player $player1, Player $player2) {
        $this->game = new Game($player1, $player2);
    }

    public function handleMessage(Message $message) {
        if (in_array($message->command, $this->commands)) {
            switch ($message->command) { 
                case "getQuestion":
                    return $this->handleGetQuestion($message->payload);
                case "answerQuestion":
                    return $this->handleAnswerQuestion($message->payload);
                case "getState":
                default:
                    return $this->handleGetState($message->payload);
            }
        }
    }

    private function handleGetQuestion($payload) {
        $questionData = $this->game->handleQuestion($payload["categoryName"],$payload["pointID"]);
        $question = array_shift($questionData);

        $response = [
            "player" => $payload["player"],
            "question" => $question,
            "answers" => $questionData,
        ];
        return $response;
    }

    private function handleAnswerQuestion($payload) {
        $this->game->handleAnswer($payload["categoryName"],$payload["pointID"], $payload["answer"]);
        $points = $this->game->getPlayerPoints($payload["player"]);

        $response = [
            "player" => $payload["player"],
            "points" => $points,
        ];
        return $response;
    }

    private function handleGetState($payload) {
        // Returns dict with game state
        $player = $payload["player"];
        $otherPlayer = $this->game->getOtherPlayer($player);
        
        $response = [
            "currentPlayer" => [
                "player" => $player,
                "points" => $this->game->getPlayerPoints($player),
                "onTurn" => $this->game->getPlayerOnTurn() === $player,
            ],
            "oppositePlayer" => [
                "player" => $otherPlayer,
                "points" => $this->game->getPlayerPoints($otherPlayer),
                "onTurn" => $this->game->getPlayerOnTurn() === $otherPlayer,
            ],
            "gameState" => [
                "isOver" => $this->game->isOver(),
                "usedQuestions" => $this->game->getUsedQuestions(),
            ],
        ];
        return $response;
    }
}