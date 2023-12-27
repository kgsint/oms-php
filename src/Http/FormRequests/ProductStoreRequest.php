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
            if(Validator::required($attributes[$name])) {
                $this->errors[$name] = str_replace(['-', '_'], ' ', ucfirst($name)) . " cannot be empty";
            }
        }

        if(! isset($attributes['category'])) {
            $this->errors['category'] = "Please select at least one category";
        }else {
            // check only when request contains category otherwise it'll overwrite the error message
            // validate - exists or not in categories table
            foreach($attributes['category'] as $categoryId) {
                if(! Validator::exists('categories', 'id', $categoryId)) {
                    $this->errors['category'] = "The category doesn't exists";
                }
            }
        }

        
    }
}