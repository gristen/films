<?php

namespace App\Kernel\Routes;

interface RouterInterface
{
    public function dispatch($uri, $method);
}
