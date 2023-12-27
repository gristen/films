<?php

namespace App\Kernel\http;

class Request implements RequestInterface
{
    public function __construct(
        private readonly array $get,
        private readonly array $post,
        private readonly array $server,
        private readonly array $files,
        private readonly array $cookies,
    ) {
    }

    public function createFromGlobals()
    {
        return new static($_GET,$_POST,$_SERVER,$_FILES,$_COOKIE);
    }

    public function uri()
    {
        return $this->server['REQUEST_URI'];
    }

    public function method()
    {
        return $this->server['REQUEST_METHOD'];
    }

    public function file()
    {
        // TODO: Implement file() method.
    }

    public function input(string $key)
    {
        return $this->post[$key];
    }
}
