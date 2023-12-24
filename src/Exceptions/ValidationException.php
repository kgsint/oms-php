<?php

namespace App\Exceptions;

use Exception;

class ValidationException extends Exception
{
    public readonly array $errors;

    public static function throw(array $errors)
    {
        // create a class instance
        $instance = new static;
        $instance->errors = $errors;
        
        throw $instance;
    }
}