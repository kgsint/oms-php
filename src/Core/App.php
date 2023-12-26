<?php 

namespace App\Core;

use App\Core\Container\Container;
use App\Exceptions\ValidationException;
use App\Exceptions\ViewNotFoundException;
use App\Exceptions\ClassNotFoundException;
use App\Exceptions\RouteNotFoundException;
use App\Exceptions\MethodNotFoundException;

class App 
{
    protected Container $container;

    public function __construct(
        private Router $router
    )
    {

    }
    
    public function run()
    {
        // resolve route
        try {
            // just uri exclude query strings
            $uri = parse_url($_SERVER['REQUEST_URI'])['path'];
            // support for PUT, PATCH, DELETE methods
            $requestMethod = isset($_POST['_method']) ? strtoupper($_POST['_method']) : $_SERVER['REQUEST_METHOD'];

            $this->router->resolve($uri, $requestMethod);
        }catch(RouteNotFoundException | ViewNotFoundException | MethodNotFoundException | ClassNotFoundException $e) {
            print($e->getMessage());
            exit;
        }catch(ValidationException $e) {
            // assign validation errors and old values to session
            $_SESSION['_flash']['errors'] = $e->errors;
            $_SESSION['_flash']['old'] = $e->oldValues;

            header('Location:' . $_SERVER['HTTP_REFERER'], response_code: 302);
            exit;
        }

        // reset validation errors and old values
        if(isset($_SESSION['_flash'])) {
            unset($_SESSION['_flash']);
        }
    }
    
}