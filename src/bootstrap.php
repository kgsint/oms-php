<?php

use App\Core\App;
use Dotenv\Dotenv;
use App\Core\Database\MySQL;
use App\Core\Database\Database;
use App\Repositories\UserRepository;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use App\Repositories\CategoryRepository;
use App\Contracts\UserRepositoryInterface;
use App\Contracts\OrderRepositoryInterface;
use App\Contracts\ProductRepositoryInterface;
use App\Contracts\CategoryRepositoryInterface;

require __DIR__ . "/constants.php";

require BASE_PATH . 'vendor/autoload.php';

// load .env
$dotenv = Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

// routes
$router = require BASE_PATH . 'src/routes.php';

// app instance
$app = new App($router);

// register/bind class entries
$app->bind(Database::class, function() {
    return match($_ENV['DB_CONNTECTION']) {
        'mysql' => new MySQL(),
    };
});

$app->bind(UserRepositoryInterface::class, fn() => new UserRepository(new Database));
$app->bind(CategoryRepositoryInterface::class, fn() => new CategoryRepository(new Database));
$app->bind(ProductRepositoryInterface::class, fn() => new ProductRepository(new Database));
$app->bind(OrderRepositoryInterface::class, fn() => new OrderRepository(new Database));

return $app;