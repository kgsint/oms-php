<?php 

namespace App\Core;

use App\Contracts\UserRepositoryInterface;
use App\Core\Container;
use App\Core\Database\Database;
use App\Exceptions\ValidationException;
use App\Exceptions\ViewNotFoundException;
use App\Exceptions\ClassNotFoundException;
use App\Exceptions\RouteNotFoundException;
use App\Exceptions\MethodNotFoundException;
use App\Repositories\UserRepository;

class App 
{
    public static Container $container;

    public function __construct(
        private Router $router,
    )
    {
        static::$container = new Container;
    }

    // bind via container bindings
    public function bind(string $key, callable $concrete): void
    {
        static::$container->bind($key, $concrete);
    }

    // resolve dependencies via container
    public static function resolve(string $key): mixed
    {
        return static::$container->resolve($key);
    }
    
    // run app
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