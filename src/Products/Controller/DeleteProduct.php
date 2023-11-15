<?php declare(strict_types=1);

namespace App\Products\Controller;

use Psr\Http\Message\ServerRequestInterface;
use React\Http\Message\Response;

final class DeleteProduct {
    public function __invoke(ServerRequestInterface $request, string $id) {
        return new Response(
            200, ['Content-type' => 'application/json'], json_encode(["message" => "DELETE request to /product/{$id}"])
        );
    }
}