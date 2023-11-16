<?php declare(strict_types=1);

namespace App\Orders\Controller;

use Psr\Http\Message\ServerRequestInterface;
use React\Http\Message\Response;
use App\Core\JsonResponse;

final class DeleteOrder {
    public function __invoke(ServerRequestInterface $request, string $id) {
        return JsonResponse::ok(["message" => "DELETE request to /order/{$id}"]);
    }
}