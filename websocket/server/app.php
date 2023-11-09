#!/usr/local/bin/php -q
<?php
require __DIR__.'/../vendor/autoload.php';

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

class Player {
    public $name;
    public $points;

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

        $questionData = $questionQuery->fetch(PDO::FETCH_ASSOC);
        $rigthAnswerData = $rightAnswerQuery->fetch(PDO::FETCH_ASSOC);
        $wrongAnswersData = $wrongAnswersQuery->fetch(PDO::FETCH_ASSOC);


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
            // You don't get points for answering twice!
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
    private $className;
    private $questions;

    
    public function getQuestion($pointValue) {

    }
    public function answerQuestion($pointValue) {

    }

}

class Game {
    // Class handling game state
    private $categories;


}

class GameHandler {
    // Class handling alternating commands from players.
    private $onTurn;
    private $players;
    private $game;

    public function __construct($player1, $player2)
    {
        
    }

}


// RATCHET MESSAGE COMPONENT
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
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
        echo sprintf('Connection %d sending message "%s" to %d other connection%s' . "\n"
            , $from->resourceId, $msg, $numRecv, $numRecv == 1 ? '' : 's');

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