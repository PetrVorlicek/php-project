#!/usr/local/bin/php -q
<?php
require __DIR__."/../vendor/autoload.php";

// MESSAGE HANDLER - SERVER GAME LOGIC
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

    public function __construct($name, $points) {
        // TODO rather than using name use ID from DB
        $this->name = $name;
        $this->points = $points;
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

    public function handleAnswer($categoryName,$pointsID,$userAnswer) {
        // Returns true if question was succesfull, false othervise
        if ($this->turnsRemaining <= 0) return false;

        if(isset($this->categories[$categoryName])) {
            // Get player
            $player = &$this->switchTurn();

            // Get points for answer
            $points = $this->categories[$categoryName]->answerQuestion($pointsID, $userAnswer);
            
            // Add points to the player
            $player->points += $points;

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

    public function isOver() {
        return $this->turnsRemaining > 0;
    }

}

class GameHandler {
    // Class handling the message interactions
    private Game $game;

    public function __construct($player1, $player2)
    {
        
    }

}


// RATCHET MESSAGE COMPONENT
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

function generateRandomString($length = 10) {
    $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $charactersLength = strlen($characters);
    $randomString = "";
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $randomString;
}

class MyChat implements MessageComponentInterface {
    
    //
    protected $clients;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn) {
        // Check if the queue is empty
        if (count($this->clients) >= 2) {
            $conn->send("This session is full!");
            return;
        }

        echo "New connection! ({$conn->resourceId})\n";

        

        // Add and greet new player
        $name = generateRandomString();
        $conn->send("Welcome, player " . $name ."!");

        foreach ($this->clients as $client) {
            $clientName = $this->clients->offsetGet($client);
            $client->send("New player just came! Your name is: $clientName");
        }

        $this->clients->offsetSet($conn, $name);
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $numRecv = count($this->clients) - 1;
        echo sprintf("Connection %d sending message '%s' to %d other connection%s" . "\n"
            , $from->resourceId, $msg, $numRecv, $numRecv == 1 ? "" : "s");

        foreach ($this->clients as $client) {
            if ($from !== $client) {
                // The sender is not the receiver, send to each client connected
                $client->send($msg);
            }
        }
    }

    public function onClose(ConnectionInterface $conn) {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);

        echo "Connection {$conn->resourceId} has disconnected\n";

        foreach ($this->clients as $client) {
            $client->send("Player " . print_r($conn->resourceId) . " has disconnected.");
        }
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }
}


// RATCHET SERVER
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;

    $server = IoServer::factory(
        new HttpServer(
            new WsServer(
                new MyChat()
            )
        ),
        8091
    );

    $server->run();
?>