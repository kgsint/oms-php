<?php 

namespace App\FormRequests;

use App\Exceptions\ValidationException;

class FormRequest
{
    protected array $errors = [];

    public function __construct(
        protected array $attributes
        ){}

    
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