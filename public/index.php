<?php

use app\core\Application;
use app\controllers\SiteController;

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$config = [
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ]
];

$app = new Application(dirname(__DIR__), $config);

$app->router->get('/', [SiteController::class, 'home']);
$app->router->get('/users', [SiteController::class, 'users']);
$app->router->get('/advertisements', [SiteController::class, 'advertisements']);

$app->run();