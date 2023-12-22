<?php

use App\Controllers\HomeController;
use App\Core\Http\Router;
use App\Core\Test;
use App\Exceptions\RouteNotFoundException;
use App\Exceptions\ViewNotFoundException;

require __DIR__ . "/../src/constants.php";

require BASE_PATH . 'vendor/autoload.php';

$router = new Router;

$router->get('/', [HomeController::class, 'index']);

$router->get('/test', [Test::class, 'test']);

// echo "<pre>";
// print_r($router->routes);
// exit;


try {
    $uri = parse_url($_SERVER['REQUEST_URI'])['path'];

    $router->resolve($uri, $_SERVER['REQUEST_METHOD']);
}catch(RouteNotFoundException $e) {
    var_dump($e->getMessage());
}catch(ViewNotFoundException $e) {
    var_dump($e->getMessage());
}

// echo "<pre>";
// var_dump($_SERVER);