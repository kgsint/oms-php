<?php

use App\Controllers\HomeController;
use App\Core\Http\Router;
use App\Core\Test;
use App\Exceptions\RouteNotFoundException;

define('BASE_PATH', __DIR__ . '/../');
define('APP_PATH', __DIR__ . '/../src/');
define('VIEW_PATH', __DIR__ . '/../src/views/');

require BASE_PATH . 'vendor/autoload.php';

$router = new Router;

$router->get('/', [HomeController::class, 'index']);

$router->get('/test', [Test::class, 'test']);

// echo "<pre>";
// print_r($router->routes);
// exit;


try {
    $router->resolve($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
}catch(RouteNotFoundException $e) {
    var_dump($e->getMessage());
}

// echo "<pre>";
// var_dump($_SERVER);