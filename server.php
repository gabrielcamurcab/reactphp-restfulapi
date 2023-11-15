<?php

use App\Products\Controller\CreateProduct;
use App\Products\Controller\GetAllProducts;
use App\Router;
use FastRoute\DataGenerator\GroupCountBased;
use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use FastRoute\RouteParser\Std;
use Psr\Http\Message\ServerRequestInterface;
use React\Http\Message\Response;
use React\Http\HttpServer;
use React\Socket\SocketServer;
use function FastRoute\simpleDispatcher;

require 'vendor/autoload.php';

$loop = \React\EventLoop\Loop::get();

$routes = new RouteCollector(new Std, new GroupCountBased);
$routes->get('/products', new GetAllProducts());
$routes->post('/products', new CreateProduct());


$server = new HttpServer(new Router($routes));

$socket = new SocketServer('127.0.0.1:8000');
$server->listen($socket);

echo 'Listening on ' . str_replace('tcp', 'http', $socket->getAddress()) . PHP_EOL;
$loop->run();
