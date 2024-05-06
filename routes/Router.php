<?php

namespace Router;

class Router
{

    public $url;
    private $routes = [];

    public function __construct($url)
    {
        $this->url = trim($url, '/');
    }

    public function get($path, $action)
    {
        $this->routes['GET'][] = new Route($path, $action);
    }

    public function post($path, $action)
    {
        $this->routes['POST'][] = new Route($path, $action);
    }

    public function run()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = $this->url;

        foreach ($this->routes[$method] as $route) {
            if ($route->matches($path)) {
                $route->executeAction();
                return;
            }
        }

        return header('HTTP/1.1 404 NOT Found');
    }
}
