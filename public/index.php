<?php

use App\Core\Http\Router;
use App\Core\Test;

define('BASE_PATH', __DIR__ . '/../');
define('APP_PATH', __DIR__ . '/../src/');
define('VIEW_PATH', __DIR__ . '/../src/views/');

require BASE_PATH . 'vendor/autoload.php';

$router = new Router;

$router->get('/', function() {
    var_dump('home');
});

$router->get('/test', [Test::class, 'test']);

$router->resolve($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);

// echo "<pre>";
// var_dump($_SERVER);