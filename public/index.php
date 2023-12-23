<?php

use App\Core\Test;
use Dotenv\Dotenv;
use App\Core\Http\Router;
use App\Core\Database\MySQL;
use App\Controllers\HomeController;
use App\Exceptions\ViewNotFoundException;
use App\Exceptions\RouteNotFoundException;

require __DIR__ . "/../src/constants.php";

require BASE_PATH . 'vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

require BASE_PATH . 'src/routes.php';

try {
    $uri = parse_url($_SERVER['REQUEST_URI'])['path'];

    $router->resolve($uri, $_SERVER['REQUEST_METHOD']);
}catch(RouteNotFoundException | ViewNotFoundException $e) {
    var_dump($e->getMessage());
    exit;
}