<?php declare(strict_types=1);

namespace App\Orders\Controller;

use Psr\Http\Message\ServerRequestInterface;
use React\Http\Message\Response;

final class DeleteOrder {
    public function __invoke(ServerRequestInterface $request, string $id) {
        return new Response(
            200, ['Content-type' => 'application/json'], json_encode(["message" => "DELETE request to /order/{$id}"])
        );
    }
}