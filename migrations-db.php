<?php

declare(strict_types=1);

use Dotenv\Dotenv;

require 'vendor/autoload.php';
$env = Dotenv::createImmutable(__DIR__, '.env');
$env->load();

return [
    'dbname' => $_ENV['DB_NAME'],
    'user' => $_ENV['DB_USER'],
    'password' => $_ENV['DB_PASS'],
    'host' => $_ENV['DB_HOST'],
    'driver' => $_ENV['DB_DRIVER'],
];