<?php 

use Dotenv\Dotenv;
use App\Exceptions\ClassNotFoundException;
use App\Exceptions\MethodNotFoundException;
use App\Exceptions\ViewNotFoundException;
use App\Exceptions\RouteNotFoundException;

require __DIR__ . "/constants.php";

require BASE_PATH . 'vendor/autoload.php';

// load .env
$dotenv = Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

// routes
require BASE_PATH . 'src/routes.php';

try {
    // just uri exclude query strings
    $uri = parse_url($_SERVER['REQUEST_URI'])['path'];
    // support for PUT, PATCH, DELETE methods
    $requestMethod = isset($_POST['_method']) ? strtoupper($_POST['_method']) : $_SERVER['REQUEST_METHOD'];

    $router->resolve($uri, $requestMethod);
}catch(RouteNotFoundException | ViewNotFoundException | MethodNotFoundException | ClassNotFoundException $e) {
    print($e->getMessage());
    exit;
}