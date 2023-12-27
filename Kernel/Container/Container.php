<?php

namespace App\Kernel\Container;

use App\Kernel\Routes\Router;
use App\Kernel\Routes\RouterInterface;

class Container
{
    public RouterInterface $router;


    public function __construct()
    {
        $this->registerService();
    }

    public function registerService(): void
    {
        $this->router = new Router();
        $
    }
}
