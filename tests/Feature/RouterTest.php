<?php

use App\Core\Http\Router;
use App\Core\Test;
use App\Exceptions\RouteNotFoundException;

it('resolves callback action', function () {
    $router = new Router;

    $router->get('/', fn() => "It resolves");

    expect($router->resolve('/', 'GET'))
                        ->toEqual("It resolves");
});

it('resolves array action', function () {
    $router = new Router;

    $router->get('/', [Test::class, 'test']);

    expect($router->resolve('/', 'GET'))
                        ->toEqual("test");
});

it('throws route not found exception when request uri does not exist', function () {
    $router = new Router;

    visit('/');

    expect(fn() => $router->resolve('/', 'GET'))
                            ->toThrow(RouteNotFoundException::class);

});