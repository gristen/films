<?php

namespace App\Kernel\Midleware;

interface MidlewareInterface
{
    public function check(array $middlewares = []);
}
