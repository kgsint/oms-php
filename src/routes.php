<?php

use App\Core\Router;
use App\Controllers\AuthController;
use App\Controllers\HomeController;
use App\Controllers\UsersController;

$router = new Router;

$router->get('/', [HomeController::class, 'index']);
$router->get('/users', [UsersController::class, 'index']);
$router->get('/users/new', [UsersController::class, 'create']);
$router->post('/users', [UsersController::class, 'store']);
$router->delete('/users', [UsersController::class, 'destroy']);

$router->get('/login', [AuthController::class, 'loginView']);
$router->post('/login', [AuthController::class, 'login']);
$router->post('/logout', [AuthController::class, 'logout']);