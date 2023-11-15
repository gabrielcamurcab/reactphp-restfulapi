<?php

use Psr\Http\Message\ServerRequestInterface;
use React\Http\Message\Response;
use React\Http\HttpServer;
use React\Socket\SocketServer;

require 'vendor/autoload.php';

$loop = \React\EventLoop\Loop::get();

$server = new HttpServer(function (ServerRequestInterface $request) {
    return new Response(
        200, ['Content-type'=> 'application/json'], json_encode(['message'=>'Hello!!'])
    );
});

$socket = new SocketServer('127.0.0.1:8000');
$server->listen($socket);

echo 'Listening on ' . str_replace('tcp', 'http', $socket->getAddress()) . PHP_EOL;
$loop->run();