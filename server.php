<?php

use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use Psr\Http\Message\ServerRequestInterface;
use React\Http\Message\Response;
use React\Http\HttpServer;
use React\Socket\SocketServer;
use function FastRoute\simpleDispatcher;

require 'vendor/autoload.php';

$loop = \React\EventLoop\Loop::get();

$dispatcher = simpleDispatcher(function (RouteCollector $routes) {
    $routes->get('/products', function (ServerRequestInterface $request) {
        return new Response(
            200, ['Content-type' => 'application/json'], json_encode(['message' => 'GET request to /products'])
        );
    });

    $routes->post('/products', function (ServerRequestInterface $request) {
        return new Response(
            200, ['Content-type' => 'application/json'], json_encode(['message' => 'POST request to /products'])
        );
    });
});

$server = new HttpServer(function (ServerRequestInterface $request) use ($dispatcher) {
    $routeInfo = $dispatcher->dispatch(
        $request->getMethod(), $request->getUri()->getPath()
    );

    switch ($routeInfo[0]) {
        case Dispatcher::NOT_FOUND:
            return new Response(404, ['Content-type' => 'application/json'], json_encode(['message' => 'Route not found']));
        case Dispatcher::METHOD_NOT_ALLOWED:
            return new Response(405, ['Content-type' => 'application/json'], json_encode(['message' => 'Method not allowed']));
        case Dispatcher::FOUND:
            return $routeInfo[1]($request);

        throw new LogicException('Something went wrong with routing.');
    }
});

$socket = new SocketServer('127.0.0.1:8000');
$server->listen($socket);

echo 'Listening on ' . str_replace('tcp', 'http', $socket->getAddress()) . PHP_EOL;
$loop->run();