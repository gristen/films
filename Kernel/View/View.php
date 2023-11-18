<?php

namespace App\Kernel\View;

use App\Kernel\Exceptions\ViewNotFoundException;
use App\Kernel\Session\SessionInterface;

class View implements ViewInterface
{
    public function __construct(
        private readonly SessionInterface $session,
    ) {

    }

    public function page(string $name): void
    {

        $viewPath = APP_PATH.'/views/pages/'.$name.'.php';

        if (! file_exists($viewPath)) {
            throw new ViewNotFoundException('путь не найден');
        }

        extract($this->defaultData());

        include_once $viewPath;
    }

    public function components(string $name): void
    {
        include_once APP_PATH.'/views/components/'.$name.'.php';
    }

    private function defaultData(): array
    {
        return [
            'view' => $this,
            'session' => $this->session,
        ];
    }
}
