<?php declare(strict_types=1);

namespace App\Orders\Controller;

use Psr\Http\Message\ServerRequestInterface;
use React\Http\Message\Response;

final class GetAllOrders {
    public function __invoke(ServerRequestInterface $request) {
        return new Response(
            200, ['Content-type' => 'application/json'], json_encode(['message' => 'GET request to /orders'])
        );
    }
}