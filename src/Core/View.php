<?php 

namespace App\Core;

class View 
{
    public function __construct(
        private string $path,
        private array $data = [],
    ){}

    public static function make(string $path, array $data = []): self
    {
        (new static($path, $data))->render();

        return new static($path, $data);
    }

    public function render()
    {
        $view = VIEW_PATH . "{$this->path}" . ".view.php";

        if(! file_exists($view)) {
            throw new \Exception('file not found');
        }
        
        extract($this->data);
        require $view;
    }

    public function __toString()
    {
        $this->render();
    }
}