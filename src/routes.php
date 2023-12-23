<?php

use App\Core\Test;
use App\Core\Http\Router;
use App\Controllers\HomeController;

$router = new Router;

$router->get('/', [HomeController::class, 'index']);

$router->get('/test', [Test::class, 'test']);