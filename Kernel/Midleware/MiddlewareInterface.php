<?php

namespace App\Kernel\Midleware;

interface MiddlewareInterface
{
    public function check(array $middlewares = []): void;
}
