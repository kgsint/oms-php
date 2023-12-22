<?php 

namespace App\Exceptions;

use Exception;

class ViewNotFoundException extends Exception
{
    protected $message = "Cannot locate view file";

    public function __construct(string $path)
    {
        $this->message = "Cannot locate View file at {$path}";
    }
}