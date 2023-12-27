<?php

use App\Core\Router;
use App\Controllers\AuthController;
use App\Controllers\HomeController;
use App\Controllers\UsersController;
use App\Controllers\CategoryController;
use App\Controllers\ProductController;

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
$router->get('/categories/new', [CategoryController::class, 'create'])->middleware('auth');
$router->post('/categories', [CategoryController::class, 'store'])->middleware('auth');
$router->get('/categories/edit', [CategoryController::class, 'edit'])->middleware('auth');
$router->patch('/categories', [CategoryController::class, 'update'])->middleware('auth');
$router->delete('/categories', [CategoryController::class, 'destroy'])->middleware('auth');

// products 
$router->get('/products', [ProductController::class, 'index'])->middleware('auth');
$router->get('/products/new', [ProductController::class, 'create'])->middleware('auth');
$router->post('/products', [ProductController::class, 'store'])->middleware('auth');
$router->get('/products/edit', [ProductController::class, 'edit'])->middleware('auth');
$router->patch('/products', [ProductController::class, 'update'])->middleware('auth');

return $router;
