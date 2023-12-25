<?php

use App\Core\Router;
use App\Controllers\AuthController;
use App\Controllers\HomeController;
use App\Controllers\UsersController;
use App\Controllers\CategoryController;

$router = new Router;

$router->get('/', [HomeController::class, 'index'])->middleware('auth');
// users
$router->get('/users', [UsersController::class, 'index'])->middleware('auth');
$router->get('/users/new', [UsersController::class, 'create'])->middleware('auth');
$router->post('/users', [UsersController::class, 'store'])->middleware('auth');
$router->delete('/users', [UsersController::class, 'destroy'])->middleware('auth');

// auth
$router->get('/login', [AuthController::class, 'loginView'])->middleware('guest');
$router->post('/login', [AuthController::class, 'login'])->middleware('guest');
$router->post('/logout', [AuthController::class, 'logout'])->middleware('auth');

// categories
$router->get('/categories', [CategoryController::class, 'index'])->middleware('auth');
$router->delete('/categories', [CategoryController::class, 'destroy'])->middleware('auth');