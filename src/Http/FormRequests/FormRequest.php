<?php 

namespace App\Http\FormRequests;

use App\Exceptions\ValidationException;

class FormRequest
{
    protected array $errors = [];

    public function __construct(
        protected array $attributes
        ){}

    public static function validate(array $attributes): self
    {
        $instance = new static($attributes);

        if($instance->hasErrors()) {
            $instance->throw();
        }

        return $instance;
    }
    
    public function hasErrors(): bool
    {
        return ! empty($this->errors);
    }

    public function throw()
    {
        throw ValidationException::throw($this->errors, $this->attributes);
    }

    public function setError(string $key, string $message): self
    {
        $this->errors[$key] = $message;

        return $this;
    }
}