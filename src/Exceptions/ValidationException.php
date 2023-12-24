<?php

namespace App\Exceptions;

use Exception;

class ValidationException extends Exception
{
    public static function throw(string $message)
    {
        // create a class instance
        $instance = new static;

        throw new $instance($message);
    }
}