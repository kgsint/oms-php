<?php

namespace App\Core;

use App\Exceptions\ClassNotFoundException;

class Container
{
    private array $bindings = [];

    public function bind(string $key, callable $concrete)
    {
        $this->bindings[$key] = $concrete;
    }

    public function has(string $key): bool
    {
        return array_key_exists($key, $this->bindings);
    }

    public function resolve(string $key)
    {
        // if there is no binding, or cannot find the key
        if(! $this->has($key)) {
            throw new ClassNotFoundException("Cannot find the binding for class {$key}");
        }

        $resolver = $this->bindings[$key];

        return call_user_func($resolver);
    }
}