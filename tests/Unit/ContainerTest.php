<?php

use Dotenv\Dotenv;
use App\Core\Container;
use App\Repositories\CategoryRepository;
use App\Contracts\CategoryRepositoryInterface;
use App\Contracts\UserRepositoryInterface;
use App\Core\App;
use App\Core\Router;
use App\Exceptions\ClassNotFoundException;

beforeEach(function() {
    new App(new Router);

    $dotenv = Dotenv::createImmutable(__DIR__ . "/../../");
    $dotenv->load();
});

it('resolves out of the container', function() {
    $container = new Container;

    $container->bind('foo', fn() => 'bar');

    expect($container->resolve('foo'))
                                        ->toEqual('bar');
});

it('throws exception when no binding is found', function() {
    $container = new Container;

    $container->bind(CategoryRepositoryInterface::class, fn() => new CategoryRepository());

    expect(fn() => $container->resolve(UserRepositoryInterface::class))
                                                                        ->toThrow(ClassNotFoundException::class);
});