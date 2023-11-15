<?php declare(strict_types=1);

namespace App\Orders\Controller;

use Psr\Http\Message\ServerRequestInterface;
use React\Http\Message\Response;

final class CreateOrder {
    public function __invoke(ServerRequestInterface $request) {
        return new Response(
            200, ['Content-type' => 'application/json'], json_encode(['message' => 'POST request to /orders'])
        );
    }
}