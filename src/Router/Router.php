<?php

namespace App\Router;

class Router
{
    public function dispatch(string $uri): void
    {

        $routes = require_once APP_PATH.'/config/routes.php';

        $routes[$uri]();
    }
}
