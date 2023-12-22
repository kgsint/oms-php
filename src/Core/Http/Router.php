<?php 

namespace App\Core\Http;

use App\Exceptions\ClassNotFoundException;
use App\Exceptions\MethodNotFoundException;

class Router 
{
    private array $routes = [];

    public function get(string $uri, callable|array $action)
    {
        $this->routes[] = [
            'method' => 'GET',
            'uri' => $uri,
            'action' => $action,
        ];
    }

    public function post(string $uri, callable|array $action)
    {
        $this->routes[] = [
            'method' => 'POST',
            'uri' => $uri,
            'action' => $action,
        ];
    }

    public function put(string $uri, callable|array $action)
    {
        $this->routes[] = [
            'method' => 'PUT',
            'uri' => $uri,
            'action' => $action,
        ];
    }

    public function patch(string $uri, callable|array $action)
    {
        $this->routes[] = [
            'method' => 'PATCH',
            'uri' => $uri,
            'action' => $action,
        ];
    }

    public function delete(string $uri, callable|array $action)
    {
        $this->routes[] = [
            'method' => 'DELETE',
            'uri' => $uri,
            'action' => $action,
        ];
    }

    public function resolve(string $uri, string $requestMethod)
    {
        foreach($this->routes as $route) {
            if($route['uri'] === $uri && $route['method'] === strtoupper($requestMethod)) {
                // if callback
                if(is_callable($route['action'])) {
                    call_user_func($route['action']);

                    return;
                }
                // if array
                if(is_array($route['action'])) {
                    [$class, $action] = $route['action'];
                }

                if(! class_exists($class)) {
                    throw new ClassNotFoundException("Cannot find class {$class}");
                }

                // if class exixts, create an instance 
                $class  = new $class;

                if(! method_exists($class, $action)) {
                    throw new MethodNotFoundException("Method {$action} does not exist in class {$class}");
                }

                // resolve
                call_user_func_array([$class, $action], []);
            }
        }
    }
}