<?php

namespace app\Views;

class Views
{
    private $extraVars = [];

    public function setVar(string $name, $value): void
    {
        $this->extraVars[$name] = $value;
    }
    function generate(string $content_view, array $vars = [],int $code = 200)
    {
        http_response_code($code);
       // extract($this->extraVars);
        extract($vars); //Функция extract извлекает массив в переменные
        ob_start(); //буфер , в случае чего мы можем обратиться к потоку вывода и отслеживать проблемы с ним

        include 'views/pages/'.$content_view;

        $buffer = ob_get_contents();
        ob_end_clean();

        echo $buffer;
    }

}