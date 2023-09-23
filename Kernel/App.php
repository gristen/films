<?php

namespace App\Kernel;

use App\Kernel\HTTP\Request;
use App\Kernel\Router\Router;

class App
{
    public function run(): void
    {

        $request = Request::createFromGlobals();

        $router = new Router();
        $router->dispatch($request->uri(), $request->method());

    }
}
