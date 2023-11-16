<?php

declare(strict_types=1);

namespace App;

use Exception;
use Psr\Http\Message\ServerRequestInterface;
use FastRoute\Dispatcher;
use FastRoute\Dispatcher\GroupCountBased;
use FastRoute\RouteCollector;
use LogicException;

use function FastRoute\simpleDispatcher;
use React\Http\Message\Response;

final class Router
{
    private $dispatcher;

    public function __construct(RouteCollector $routes)
    {
        $this->dispatcher = new GroupCountBased($routes->getData());
    }

    public function __invoke(ServerRequestInterface $request)
    {

        $routeInfo = $this->dispatcher->dispatch(
            $request->getMethod(),
            $request->getUri()->getPath()
        );

        switch ($routeInfo[0]) {
            case Dispatcher::NOT_FOUND:
                return new Response(404, ['Content-type' => 'application/json'], json_encode(['message' => 'Route not found']));
            case Dispatcher::METHOD_NOT_ALLOWED:
                return new Response(405, ['Content-type' => 'application/json'], json_encode(['message' => 'Method not allowed']));
            case Dispatcher::FOUND:
                $params = array_values($routeInfo[2]);
                return $routeInfo[1]($request, ...$params);

            throw new LogicException('Something went wrong with routing.');
        }
    }
}
