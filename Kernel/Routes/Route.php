<?php

namespace App\Kernel\Routes;

class Route
{
    public function __construct(
        private $uri,
        private $method,
        private $action,
    ) {

    }

    public function getUri()
    {
        return $this->uri;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getAction()
    {
        return $this->action;
    }

    public static function get(string $uri, $action)
    {
        return new static($uri,'GET',$action);
    }
}
