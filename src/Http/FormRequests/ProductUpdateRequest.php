<?php 

namespace App\Http\FormRequests;

use App\Core\Validator;

class ProductUpdateRequest extends FormRequest
{
    public function __construct(
        protected array $attributes,
    )
    {
        parent::__construct($attributes);

        // required validations
        foreach($attributes as $name => $value) {
            if(Validator::required($attributes[$name])) {
                    $this->errors[$name] = str_replace(['-', '_'], ' ', ucfirst($name)) . " cannot be empty";
            }
        }

        // validate categorires
        if(! isset($attributes['categories'])) {
            $this->errors['categories'] = "Please select at least one category";
        }else {
            // check only when request contains category otherwise it'll overwrite the error message
            foreach($attributes['categories'] as $categoryId) {
                // validate - exists or not in categories table
                if(! Validator::exists('categories', 'id', $categoryId)) {
                    $this->errors['categories'] = "The category doesn't exists";
                }
            }
        }

    }
}