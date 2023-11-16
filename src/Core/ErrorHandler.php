<?php declare(strict_types=1);

namespace App\Core;

use App\Core\JsonResponse;
use Psr\Http\Message\ServerRequestInterface;
use React\Http\Message\Response;
use Throwable;

final class ErrorHandler {
    public function __invoke(ServerRequestInterface $request, callable $next)
    {
        try {
            return $next($request);
        } catch (Throwable $error) {
            return JsonResponse::internalServerError($error->getMessage());
        }
    }
}