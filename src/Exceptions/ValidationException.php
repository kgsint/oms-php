<?php

namespace App\Exceptions;

use Exception;

class ValidationException extends Exception
{
    public readonly array $errors;
    public readonly array $oldValues;

    public static function throw(array $errors, array $old)
    {
        // create a class instance
        $instance = new static;
        $instance->errors = $errors;
        $instance->oldValues = $old;
        
        throw $instance;
    }
}