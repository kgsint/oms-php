<?php

use Dotenv\Dotenv;
use App\Models\User;
use App\Core\Database\Database;
use App\Repositories\UserRepository;
use App\Exceptions\ViewNotFoundException;
use App\Exceptions\RouteNotFoundException;

require __DIR__ . "/../src/constants.php";

require BASE_PATH . 'vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

require BASE_PATH . 'src/routes.php';

try {
    $uri = parse_url($_SERVER['REQUEST_URI'])['path'];
    // support for PUT, PATCH, DELETE methods
    $requestMethod = isset($_POST['_method']) ? strtoupper($_POST['_method']) : $_SERVER['REQUEST_METHOD'];

    $router->resolve($uri, $requestMethod);
}catch(RouteNotFoundException | ViewNotFoundException $e) {
    var_dump($e->getMessage());
    exit;
}