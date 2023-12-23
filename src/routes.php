<?php

use App\Core\Http\Router;
use App\Controllers\HomeController;
use App\Controllers\UsersController;

$router = new Router;

$router->get('/', [HomeController::class, 'index']);
$router->get('/users', [UsersController::class, 'index']);
$router->get('/users/new', [UsersController::class, 'create']);
$router->post('/users', [UsersController::class, 'store']);
$router->delete('/users', [UsersController::class, 'destroy']);