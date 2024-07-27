<?php

declare(strict_types=1);

namespace Core\Tools;

class Router {
    protected array $routes = [];

    public function get(string $uri,string $callback): void {
        $this->routes['GET'][$uri] = $callback;
    }

    public function post(string $uri,string $callback): void {
        $this->routes['POST'][$uri] = $callback;
    }

    public function dispatch(string $uri): void {
        $method = $_SERVER['REQUEST_METHOD'];
        if (isset($this->routes[$method][$uri])) {
            $callback = $this->routes[$method][$uri];
            if (is_callable($callback)) {
                call_user_func($callback);
            } elseif (is_string($callback)) {
                $this->callController($callback, $uri);
            }
        } else {
            echo "404 Not Found";
        }
    }

    protected function callController(string $callback, string $uri): void {
        list($controller, $method) = explode('@', $callback);
        $controller = 'Core\\Controllers\\' . "$controller";
        
        if (class_exists($controller) && method_exists($controller, $method)) {
            $controllerInstance = new $controller();
            $controllerInstance->$method();
        } else {
            echo "Controller or method not found";
        }
    }
}