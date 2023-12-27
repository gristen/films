<?php

namespace App\Kernel\http;

interface RequestInterface
{
    public function createFromGlobals();

    public function uri();

    public function method();

    public function file();

    public function input(string $key);
}
