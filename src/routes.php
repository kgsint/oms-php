<?php

use App\Core\Http\Router;
use App\Controllers\HomeController;
use App\Controllers\UsersController;

$router = new Router;

$router->get('/', [HomeController::class, 'index']);
$router->get('/users', [UsersController::class, 'index']);