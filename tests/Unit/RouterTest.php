<?php

use App\Core\Http\Router;

beforeEach(function() {
    $this->router = new Router;
});

it('registers get method', function() {
    $router = new Router;
    $router->get('/', fn() => "GET route");

    expect($router->getRoutes()[0])->toMatchArray([
        'method' => 'GET',
        'uri' => '/',
    ]);
});

it('it registers post method', function() {
    $router = new Router;
    $router->post('/store', fn() => "POST route");

    expect($router->getRoutes()[0])->toMatchArray([
        'method' => 'POST',
        'uri' => '/store',
    ]);
});

it('registers put method', function() {
    $router = new Router;
    $router->put('/update', fn() => "PUT route");

    expect($router->getRoutes()[0])->toMatchArray([
        'method' => 'PUT',
        'uri' => '/update',
    ]);
});

it('it registers patch method', function() {
    $router = new Router;
    $router->patch('/update', fn() => "PATCH route");

    expect($router->getRoutes()[0])->toMatchArray([
        'method' => 'PATCH',
        'uri' => '/update',
    ]);
});

it('it registers delete method', function() {
    $router = new Router;
    $router->delete('/delete', fn() => "DELETE route");

    expect($router->getRoutes()[0])->toMatchArray([
        'method' => 'DELETE',
        'uri' => '/delete',
    ]);
});