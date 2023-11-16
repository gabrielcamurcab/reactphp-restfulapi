<?php

use App\Core\ErrorHandler;
use App\Orders\Controller\CreateOrder;
use App\Orders\Controller\DeleteOrder;
use App\Orders\Controller\GetAllOrders;
use App\Orders\Controller\GetOrderById;
use App\Orders\Controller\UpdateOrder;
use App\Products\Controller\CreateProduct;
use App\Products\Controller\DeleteProduct;
use App\Products\Controller\GetAllProducts;
use App\Products\Controller\GetProductById;
use App\Products\Controller\UpdateProduct;
use App\Core\Router;
use FastRoute\DataGenerator\GroupCountBased;
use FastRoute\RouteCollector;
use FastRoute\RouteParser\Std;
use React\Http\HttpServer;
use React\Socket\SocketServer;

require 'vendor/autoload.php';

$loop = \React\EventLoop\Loop::get();

$routes = new RouteCollector(new Std, new GroupCountBased);

// Routes for products
$routes->get('/products', new GetAllProducts());
$routes->post('/products', new CreateProduct());
$routes->get('/product/{id:\d+}', new GetProductById());
$routes->put('/product/{id:\d+}', new UpdateProduct());
$routes->delete('/product/{id:\d+}', new DeleteProduct());

$routes->get('/orders', new GetAllOrders());
$routes->post('/orders', new CreateOrder());
$routes->get('/order/{id:\d+}', new GetOrderById());
$routes->put('/order/{id:\d+}', new UpdateOrder());
$routes->delete('/order/{id:\d+}', new DeleteOrder());


$server = new HttpServer(new ErrorHandler(), new Router($routes));

$socket = new SocketServer('127.0.0.1:8000');
$server->listen($socket);

$server->on('error', function (Throwable $error) {
    echo 'Error: ' . $error->getMessage() . PHP_EOL;
});

echo 'Listening on ' . str_replace('tcp', 'http', $socket->getAddress()) . PHP_EOL;
$loop->run();
