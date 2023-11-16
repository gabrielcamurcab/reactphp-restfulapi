<?php declare(strict_types=1);

namespace App\Core;

use Psr\Http\Message\ServerRequestInterface;
use React\Http\Message\Response;
use Throwable;

final class ErrorHandler {
    public function __invoke(ServerRequestInterface $request, callable $next)
    {
        try {
            return $next($request);
        } catch (Throwable $error) {
            return new Response(
                500,
                ['Content-type' => 'application/json'],
                json_encode(['message' => $error->getMessage()])
            );
        }
    }
}