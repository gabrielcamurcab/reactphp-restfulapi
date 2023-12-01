<?php

use App\Core\ErrorHandler;
use App\Core\JsonRequestDecoder;
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
use Dotenv\Dotenv;
use FastRoute\DataGenerator\GroupCountBased;
use FastRoute\RouteCollector;
use FastRoute\RouteParser\Std;
use React\Http\HttpServer;
use React\MySQL\QueryResult;
use React\Socket\SocketServer;
use App\Products\Storage as Products;

require 'vendor/autoload.php';
$env = Dotenv::createImmutable(__DIR__, '.env');
$env->load();

$loop = \React\EventLoop\Loop::get();
$mysql = new \React\MySQL\Factory($loop);
$uri = $_ENV['DB_USER'] . ':' . $_ENV['DB_PASS'] . '@' . $_ENV['DB_HOST'] . '/' . $_ENV['DB_NAME'];
$connection = $mysql->createLazyConnection($uri);
$products = new Products($connection);

$routes = new RouteCollector(new Std, new GroupCountBased);

// Routes for products
$routes->get('/products', new GetAllProducts($products));
$routes->post('/products', new CreateProduct($products));
$routes->get('/product/{id:\d+}', new GetProductById($products));
$routes->put('/product/{id:\d+}', new UpdateProduct($products));
$routes->delete('/product/{id:\d+}', new DeleteProduct($products));

$routes->get('/orders', new GetAllOrders());
$routes->post('/orders', new CreateOrder());
$routes->get('/order/{id:\d+}', new GetOrderById());
$routes->put('/order/{id:\d+}', new UpdateOrder());
$routes->delete('/order/{id:\d+}', new DeleteOrder());


$server = new HttpServer(new ErrorHandler(), new JsonRequestDecoder(), new Router($routes));

$middleware = new SocketServer('127.0.0.1:8000');
$server->listen($middleware);

$server->on('error', function (Throwable $error) {
    echo 'Error: ' . $error->getMessage() . PHP_EOL;
});

echo 'Listening on ' . str_replace('tcp', 'http', $middleware->getAddress()) . PHP_EOL;
$loop->run();
