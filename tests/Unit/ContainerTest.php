<?php

use Dotenv\Dotenv;
use App\Core\Container;
use App\Core\Database\Database;
use App\Repositories\CategoryRepository;
use App\Contracts\CategoryRepositoryInterface;
use App\Contracts\UserRepositoryInterface;
use App\Exceptions\ClassNotFoundException;

beforeEach(function() {
    $dotenv = Dotenv::createImmutable(__DIR__ . "/../../");
    $dotenv->load();
});

it('resolves out of the container', function() {
    $container = new Container;

    $container->bind('foo', fn() => 'bar');

    expect($container->resolve('foo'))
                                        ->toEqual('bar');
});

it('resolves class instance with dependencies', function() {
    $container = new Container;

    $container->bind(CategoryRepositoryInterface::class, fn() => new CategoryRepository(new Database));

    expect($container->resolve(CategoryRepositoryInterface::class))->toBeInstanceOf(CategoryRepository::class);
});

it('throws class not found exception when no binding is found', function() {
    $container = new Container;

    $container->bind(CategoryRepositoryInterface::class, fn() => new CategoryRepository(new Database));

    expect(fn() => $container->resolve(UserRepositoryInterface::class))
                                                                        ->toThrow(ClassNotFoundException::class);
});