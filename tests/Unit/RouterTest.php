<?php

use App\Core\Http\Router;

beforeEach(function() {
    $this->router = new Router;
});

it('registers get method', function() {
    $router = new Router;
    $router->get('/', fn() => "GET route");

    test()->assertEquals('GET', $router->getRoutes()[0]['method']);
    test()->assertEquals('/', $router->getRoutes()[0]['uri']);
});

it('it registers post method', function() {
    $router = new Router;
    $router->post('/store', fn() => "POST route");

    test()->assertEquals('POST', $router->getRoutes()[0]['method']);
    test()->assertEquals('/store', $router->getRoutes()[0]['uri']);
});

it('registers put method', function() {
    $router = new Router;
    $router->put('/update', fn() => "PUT route");

    test()->assertEquals('PUT', $router->getRoutes()[0]['method']);
    test()->assertEquals('/update', $router->getRoutes()[0]['uri']);
});

it('it registers patch method', function() {
    $router = new Router;
    $router->patch('/update', fn() => "PATCH route");

    test()->assertEquals('PATCH', $router->getRoutes()[0]['method']);
    test()->assertEquals('/update', $router->getRoutes()[0]['uri']);
});

it('it registers delete method', function() {
    $router = new Router;
    $router->delete('/delete', fn() => "DELETE route");

    test()->assertEquals('DELETE', $router->getRoutes()[0]['method']);
    test()->assertEquals('/delete', $router->getRoutes()[0]['uri']);
});