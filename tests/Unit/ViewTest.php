<?php

use App\Core\View;
use App\Exceptions\ViewNotFoundException;

require __DIR__ . "/../../src/constants.php";

it('renders when invoke make static method', function() {
    expect((new View('index', ['foo' => 'bar'])))
                                ->toBeInstanceOf(View::class)
                                ->toBeObject();
});

it('throws ViewNotFound exception when try to render unexisted file', function() {
    expect(fn() => View::make('non-exist-file'))
                        ->toThrow(ViewNotFoundException::class);
});