<?php

namespace App\FormRequests;

use App\Core\Validator;
use App\Exceptions\ValidationException;

class UserStoreRequest 
{
    public array $errors = [];

    public function __construct(
       array $attributes,
    )
    {
        // required validation
        foreach($attributes as $name => $value) {
            if(Validator::required($attributes[$name])) {
                $this->errors[$name] = str_replace(['-', '_'], ' ', ucfirst($name)) . " cannot be empty";
            }
        }

        // confirm password validation
        if($attributes['password'] && ! Validator::confirm($attributes['password'], $attributes['password_confirmation'])) {
            $this->errors['password'] = "Password confirmation do not match";
        }
    }

    public static function validate(array $attributes): self
    {
        $instance = new static($attributes);

        if(! empty($instance->errors)) {
            ValidationException::throw($instance->errors, $attributes);
        }

        return $instance;
    }
}