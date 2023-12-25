<?php 

namespace App\Http\FormRequests;

use App\Core\Validator;

class CategoryUpdateRequest extends FormRequest
{
    public function __construct(
        protected array $attributes
    )
    {
        parent::__construct($attributes);

        if(Validator::required($attributes['name'])) {
            $this->errors['name'] = "Name cannot be empty";
        }

        // find the name is already taken or not, excluding current category id
        if(Validator::exists('categories', 'name', $attributes['name'], except: (int) $attributes['id'])) {
            $this->errors['name'] = "The given category already exists";
        }
    }
}