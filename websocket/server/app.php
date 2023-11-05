#!/usr/local/bin/php -q
<?php
require __DIR__.'/../vendor/autoload.php';

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class MyChat implements MessageComponentInterface {
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

        foreach ($this->clients as $client) {
            $client->send("New player just came! " . print_r(get_object_vars($conn)));
        }
        
        

        echo "New connection! ({$conn->resourceId})\n";
        $conn->send("Welcome, player!");
        // Finally, add new player to clients to send messages to later

        $this->clients->attach($conn);
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