<?php 

namespace App\Core;

use App\Core\Container;
use App\Exceptions\ValidationException;
use App\Exceptions\ViewNotFoundException;
use App\Exceptions\ClassNotFoundException;
use App\Exceptions\RouteNotFoundException;
use App\Exceptions\MethodNotFoundException;
use Error;
use PDOException;

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
        $this->resolveRouter();
        // reset validation errors and old values
        Session::flush();
    }

    private function resolveRouter()
    {
        // resolve route
        try {
            // just uri exclude query strings
            $uri = parse_url($_SERVER['REQUEST_URI'])['path'];
            // support for PUT, PATCH, DELETE methods
            $requestMethod = isset($_POST['_method']) ? strtoupper($_POST['_method']) : $_SERVER['REQUEST_METHOD'];

            $this->router->resolve($uri, $requestMethod);
        }catch(Error $e) {
            // optional error message display
            if($_ENV['APP_DEBUG'] === "true") {
                print($e->getMessage());
                exit;
            }else {
                abort(500);
            }
        }catch(ValidationException $e) {
            // assign validation errors and old values to session
            $_SESSION['_flash']['errors'] = $e->errors;
            $_SESSION['_flash']['old'] = $e->oldValues;

            header('Location:' . $_SERVER['HTTP_REFERER'], response_code: 302);
            exit;
        }
    }
}