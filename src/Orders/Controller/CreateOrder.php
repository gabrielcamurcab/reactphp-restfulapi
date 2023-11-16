<?php declare(strict_types=1);

namespace App\Orders\Controller;

use Psr\Http\Message\ServerRequestInterface;
use React\Http\Message\Response;
use App\Core\JsonResponse;

final class CreateOrder {
    public function __invoke(ServerRequestInterface $request) {
        return JsonResponse::ok(['message' => 'POST request to /orders']);
    }
}