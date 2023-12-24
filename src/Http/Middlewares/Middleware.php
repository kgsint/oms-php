<?php 

namespace App\Http\Middlewares;

use App\Exceptions\MiddlewareNotFoundException;

class Middleware
{
    const MAP = [
        'auth' => RedirectIfGuest::class,
        'guest' => RedirectIfAuthenticated::class,
    ];

    // resolve middleware via MAP key
    public static function resolve(?string $key)
    {
        if(! $key) {
            return;
        }
        
        /** @var \App\Contracts\MiddlewareInterface $middleware */
        $middleware = self::MAP[$key];

        // if key => value pair does not exist
        if(! $middleware) {
            throw new MiddlewareNotFoundException("Cannot find middleware for {$key}");
        }

        // if does exist, invoke handle method
        (new $middleware)->handle();
    }
}