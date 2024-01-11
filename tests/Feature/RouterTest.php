<?php

use Dotenv\Dotenv;
use App\Core\Router;
use Tests\TestController;
use App\Exceptions\RouteNotFoundException;

beforeEach(function() {
    $dotenv = Dotenv::createImmutable(__DIR__ . "/../../");
    $dotenv->load();
});

it('resolves callback action', function () {
    $router = new Router;

    $router->get('/', fn() => "It resolves");

    expect($router->resolve('/', 'GET'))
                        ->toEqual("It resolves");
});

it('resolves array action', function () {
    $router = new Router;

    $router->get('/', [TestController::class, 'test']);

    test()
            ->assertEquals('test', $router->resolve('/', 'GET'));
});

it('throws route not found exception when request uri does not exist', function () {
    expect(fn() => get('/somewhere'))
                    ->toThrow(RouteNotFoundException::class);

});