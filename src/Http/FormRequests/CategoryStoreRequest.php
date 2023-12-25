<?php 

namespace App\Http\FormRequests;

use App\Core\Validator;

class CategoryStoreRequest extends FormRequest
{
    public function __construct(
        protected array $attributes
    )
    {
        parent::__construct($attributes);

        if(Validator::required($attributes['name'])) {
            $this->errors['name'] = "Name cannot be empty";
        }

        if(Validator::exists('categories', 'name', $attributes['name'])) {
            $this->errors['name'] = "The given category already exists";
        }
    }
}