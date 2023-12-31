<?php

namespace App\Http\FormRequests;

use App\Core\Validator;
use App\Exceptions\ValidationException;

class UserStoreRequest extends FormRequest
{
    public function __construct(
       protected array $attributes,
    )
    {
        // required validation
        foreach($attributes as $name => $value) {
            if(Validator::required($attributes[$name])) {
                $this->errors[$name] = str_replace(['-', '_'], ' ', ucfirst($name)) . " cannot be empty";
            }
        }

        if(! Validator::email($attributes['email'])) {
            $this->errors['email'] = "Please provide a valid email";
        }

        if(Validator::exists('users', 'email', $attributes['email'])) {
            $this->errors['email'] = "This email has already been taken";
        }

        // confirm password validation
        if($attributes['password'] && ! Validator::confirm($attributes['password'], $attributes['password_confirmation'])) {
            $this->errors['password'] = "Password confirmation does not match";
        }
    }
}