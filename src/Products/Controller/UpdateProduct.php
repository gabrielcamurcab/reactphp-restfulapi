<?php declare(strict_types=1);

namespace App\Products\Controller;

use Psr\Http\Message\ServerRequestInterface;
use React\Http\Message\Response;
use App\Core\JsonResponse;

final class UpdateProduct {
    public function __invoke(ServerRequestInterface $request, string $id) {
        return JsonResponse::ok(["message" => "PUT request to /product/{$id}"]);
    }
}