<?php

namespace App\Kernel\Routes;

class Router
{
    private array $routes = [
        'GET' => [],
        'POST' => [],

    ];

    public function __construct()
    {
        $this->initRoutes();
    }

    public function dispatch(string $uri, string $method): void
    {

    }

    private function findRoute($uri, $method): Route|false
    {
        return $this->routes[$method][$uri];
    }

    private function initRoutes()
    {
        $routes = $this->getRoutes();
        foreach ($routes as $route) {
            $this->routes[$route->getMethod()][$route->getUri()] = $route; // в ключ мы вносим метод , а в значение уже ури

        }
    }

    /**
     * @return Route[]
     */
    private function getRoutes(): array
    {
        return require APP_PATH.'/config/routes.php';
    }
}
