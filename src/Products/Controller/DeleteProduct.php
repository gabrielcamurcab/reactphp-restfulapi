<?php declare(strict_types=1);

namespace App\Products\Controller;

use App\Core\JsonResponse;
use Psr\Http\Message\ServerRequestInterface;
use React\Http\Message\Response;

final class DeleteProduct {
    public function __invoke(ServerRequestInterface $request, string $id) {
        return JsonResponse::ok(["message" => "DELETE request to /product/{$id}"]);
    }
}