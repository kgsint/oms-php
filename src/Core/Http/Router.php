<?php 

namespace App\Core\Http;

use App\Exceptions\ClassNotFoundException;
use App\Exceptions\MethodNotFoundException;
use App\Exceptions\RouteNotFoundException;

class Router 
{
    private array $routes = [];

    public function registerRoutes(string $method, string $uri, callable|array $action)
    {
        $this->routes[] = [
            'method' => $method,
            'uri' => $uri,
            'action' => $action,
        ];
    }

    public function get(string $uri, callable|array $action)
    {
        $this->registerRoutes(
            method: 'GET',
            uri: $uri,
            action: $action,
        );
    }

    public function post(string $uri, callable|array $action)
    {
        $this->registerRoutes(
            method: 'POST',
            uri: $uri,
            action: $action,
        );
    }

    public function put(string $uri, callable|array $action)
    {
        $this->registerRoutes(
            method: 'PUT',
            uri: $uri,
            action: $action,
        );
    }

    public function patch(string $uri, callable|array $action)
    {
        $this->registerRoutes(
            method: 'PATCH',
            uri: $uri,
            action: $action,
        );
    }

    public function delete(string $uri, callable|array $action)
    {
        $this->registerRoutes(
            method: 'DELETE',
            uri: $uri,
            action: $action,
        );
    }

    public function resolve(string $uri, string $requestMethod)
    {
        foreach($this->routes as $route) {
            if($route['uri'] === $uri && $route['method'] === strtoupper($requestMethod)) {
                return $this->routeToAction($route['action']);
            }
        }

        throw new RouteNotFoundException('Cannot find ' . $requestMethod . ' route for "' . $uri . '"');
    }

    public function getRoutes(): array
    {
        return $this->routes;
    }

    private function routeToAction(array|callable $action)
    {
        // if callback
        if(is_callable($action)) {
            return call_user_func($action);
        }

        // if array
        if(is_array($action)) {
            [$class, $action] = $action;

            if(! class_exists($class)) {
                throw new ClassNotFoundException("Cannot find class {$class}");
            }

            // if class exists, create an instance 
            $class  = new $class();

            if(! method_exists($class, $action)) {
                throw new MethodNotFoundException("Method {$action} does not exist in class {$class}");
            }

            // resolve
            return call_user_func_array([$class, $action], []);
        }
        
    }
}