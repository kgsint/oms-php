<?php

namespace App\Http\FormRequests;

use App\Core\Validator;

class LoginFormRequest extends FormRequest
{
    public function __construct(
       protected array $attributes,
    )
    {
        parent::__construct($attributes);
        // required validation
        foreach($attributes as $name => $value) {
            if(Validator::required($attributes[$name])) {
                $this->errors[$name] = str_replace(['-', '_'], ' ', ucfirst($name)) . " cannot be empty";
            }
        }
    }

}