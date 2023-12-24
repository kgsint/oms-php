<?php

use App\Core\Test;
use App\Core\View;
use Dotenv\Dotenv;
use App\Core\Http\Router;
use App\Controllers\HomeController;
use App\Exceptions\RouteNotFoundException;
use App\Exceptions\ViewNotFoundException;

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
    require __DIR__ . "/../../src/constants.php";
    $router = new Router;

    $router->get('/', [HomeController::class, 'index']);
    $_SERVER['REQUEST_URI'] = '/';
    $_SERVER['REQUEST_METHOD'] = 'GET';

    test()
            ->assertInstanceOf(View::class, 
                            $router->resolve($_SERVER['REQUEST_URI'], 
                            $_SERVER['REQUEST_METHOD'])
                        );
});

it('throws route not found exception when request uri does not exist', function () {
    expect(fn() => get('/'))
                    ->toThrow(RouteNotFoundException::class);

});