<?php 

namespace App\Http\FormRequests;

use App\Core\Validator;

class ProductStoreRequest extends FormRequest
{
    public function __construct(
        protected array $attributes
    )
    {
        parent::__construct($attributes);

        // required validation
        foreach($attributes as $name => $value) {
            // active field is nullable and default is false (0)
            // if($name !== 'active') {
                if(Validator::required($attributes[$name])) {
                    $this->errors[$name] = str_replace(['-', '_'], ' ', ucfirst($name)) . " cannot be empty";
                // }
            }
        }

        // validate category record
        if(! Validator::exists('categories', 'id', $attributes['category'])) {
            $this->errors['category'] = "The category doesn't exists";
        }
    }
}