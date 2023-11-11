<?php
require __DIR__."/../vendor/autoload.php";
include "./game.php";
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

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