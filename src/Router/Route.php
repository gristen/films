<?php

namespace App\Router;

class Route
{
    public function __construct(
        private string $uri,
        private string $method,
        private $action
    ) {
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getAction()
    {
        return $this->action;
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public static function get(string $uri, $action): static
    {
        return new static($uri,'GET',$action); // создаем экземпляр класса
    }

    public static function post(string $uri, $action): static
    {
        return new static($uri,'POST',$action);
    }
}
