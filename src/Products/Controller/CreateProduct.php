<?php declare(strict_types=1);

namespace App\Products\Controller;

use App\Core\JsonResponse;
use Psr\Http\Message\ServerRequestInterface;
use React\Http\Message\Response;

final class CreateProduct {
    public function __invoke(ServerRequestInterface $request) {
        return JsonResponse::ok(['message' => 'POST request to /products']);
    }
}