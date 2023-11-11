<?php

namespace App\Kernel\View;

use App\Kernel\Exceptions\ViewNotFoundException;

class View
{
    public function page(string $name): void
    {

        $viewPath = APP_PATH.'/views/pages/'.$name.'.php';

        if (! file_exists($viewPath)) {
            throw new ViewNotFoundException('путь не найден');
        }

        extract([
            'view' => $this,
        ]);

        include_once $viewPath;
    }

    public function components(string $name): void
    {
        include_once APP_PATH.'/views/components/'.$name.'.php';
    }
}
