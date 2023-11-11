#!/usr/local/bin/php -q
<?php
require __DIR__."/../vendor/autoload.php";
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
include __DIR__."/messageHandler.php";

$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new MessageHandler()
        )
    ),
    8091
);

$server->run();
