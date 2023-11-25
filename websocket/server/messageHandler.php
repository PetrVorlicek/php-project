<?php
require __DIR__."/../../vendor/autoload.php";
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
include __DIR__."/game.php";

function generateRandomString($length = 10) {
    // Random string generator for assigning player names
    $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $charactersLength = strlen($characters);
    $randomString = "";
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $randomString;
}

// TODO players are random now, add loading and saving from DB
class MessageHandler implements MessageComponentInterface {
    
    //
    protected $clients;

    private $gameHandler;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn) {
        // Check if the queue is empty
        if (count($this->clients) >= 2) {
            $errorMessage = ["type" =>"error", 
            "payload" => "This session is full!"];
            $conn->send(json_encode($errorMessage));
            return;
        }
        // Save the player connection and his name
        $name = generateRandomString();
        $this->clients->offsetSet($conn, $name);

        $this->greet();
        
        if (count($this->clients) === 2 && !isset($this->gameHandler)) {
            $this->startGame();
        }
    }

    public function onMessage(ConnectionInterface $from, $message) {
        $parsedMessage = json_decode($message, true);
        $senderName = $parsedMessage["payload"]["player"];
        //echo print_r($parsedMessage);
        // Guard game end
        if (!isset($this->gameHandler))
        {
            return;
        }
        if ($this->gameHandler->isOver()) {
            // Game end can be handled by data from state on frontend
            $this->broadcastState();
            return;
        }

        // Guard player on turn
        if (!$this->gameHandler->checkOnTurn($senderName)) {
            // If the player is not on turn, we send state message
            $this->broadcastState();
            return;
        }

        // Create handleable message for gameHandler
        $msg = Message::createFromClientMessage($parsedMessage);
        $response = $this->gameHandler->handleMessage($msg);

        $parsedResponse = json_encode($response);
        $from->send($parsedResponse);
        $this->broadcastState();

    }

    public function onClose(ConnectionInterface $conn) {
        
        // Try getting playername
        $playerName = null;
        try {
            $playerName = $this->clients->offsetGet($conn);
        } catch (\Exception $e) {
            // Does not work without the catch unfortunatelly
            $playerName = null;
        }

        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);

        echo $playerName . " has disconnected.";

        foreach ($this->clients as $client) {
            if ($playerName !== null) {
                $warning = ["type" => "warning",
                "payload"=>[
                    "message"=>"Player {$playerName} has disconnected.", 
                    "disconnect" => $playerName,],
                ];
                $client->send(json_encode($warning));
            }
        }

        // Continue game if there are 2 clients ready
        if (count($this->clients) === 2) {
            return;
        }
        // Destroy the game
        if ($this->gameHandler !== null) {
            $this->gameHandler = null;
        }
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }

    /* PRIVATE FUNCTIONS */
    private function greet() {
        // Yield all client names
        $clientNames = $this->getClientNames();
        
        // Greet all clients 
        foreach ($this->clients as $client) {
            $clientName = $this->clients->offsetGet($client);
            $greet = ["type" => "greet",
                "payload" => [
                "player" => $clientName,
                "allPlayers" => $clientNames,]
            ,];
            
            $client->send(json_encode($greet));
        }
    }

    private function getClientNames() {
        // Yield client names in array
        $clientNames = [];
        foreach ($this->clients as $client) {
            $clientName = $this->clients->offsetGet($client);
            $clientNames[] = $clientName;
         }
         return $clientNames;
    }

    private function startGame() {
        $clientNames = $this->getClientNames();
        $players = [];
        foreach  ($clientNames as $playerName) {
            $players[] = new Player($playerName);
        }
        if (count($players) === 2)   {
            $this->gameHandler = new GameHandler($players[0], $players[1]);
            // game has officially started

            // getQuestion","answerQuestion","getState
            foreach ($this->clients as $client) {
                $playerName = $this->clients->offsetGet($client);
                $message = new Message("getState", ["player" => $playerName]);
                $state = $this->gameHandler->handleMessage($message);
                $response = ["type" => "gameStart",
                "payload" => $state, 
                ];

                $client->send(json_encode($response));
            }

            return true;
        }
        return false;
    }

    private function broadcastState() {
        // Send state update to all clients
        foreach ($this->clients as $client) {
            $message = new Message("getState", ["player"=>$this->clients->offsetGet($client)]);
            $response = $this->gameHandler->handleMessage($message);
            $parsedResponse = json_encode($response);

            $client->send($parsedResponse);
        }
    }
}