<?php

namespace App\Kernel\HTTP;

class Request
{
    public function __construct(
        public readonly array $get,
        public readonly array $post,
        public readonly array $server,
        public readonly array $files,
        public readonly array $cookies,
        //readonly - читать можно изменять нет
    ) {

    }

    public static function createFromGlobals(): static
    {
        return new static(
            $_GET,
            $_POST,
            $_SERVER,
            $_FILES,
            $_COOKIE
        );
    }

    public function uri(): string
    {
        return strtok($this->server['REQUEST_URI'], '?'); // после токена строка обрезается
    }

    public function method(): string
    {
        return $this->server['REQUEST_METHOD'];
    }

    public function input(string $key, $default = null)
    {
        return $this->post[$key] ?? $this->get[$key] ?? $default; //если позт нулл и гет нулл то тогда дефаулт вернет
    }
}
