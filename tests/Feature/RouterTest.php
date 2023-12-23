<?php

use App\Controllers\HomeController;
use App\Core\Http\Router;
use App\Core\Test;
use App\Core\View;
use App\Exceptions\RouteNotFoundException;

require __DIR__ . "/../../src/constants.php";

it('resolves callback action', function () {
    $router = new Router;

    $router->get('/', fn() => "It resolves");

    expect($router->resolve('/', 'GET'))
                        ->toEqual("It resolves");
});

it('resolves array action', function () {
    $router = new Router;

    $router->get('/', [HomeController::class, 'index']);

    expect($router->resolve('/', 'GET'))
                                    ->toBeInstanceOf(View::class);
});

it('throws route not found exception when request uri does not exist', function () {
    expect(fn() => get('/'))
                    ->toThrow(RouteNotFoundException::class);

});