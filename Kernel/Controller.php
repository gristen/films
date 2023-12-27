<?php

namespace App\Kernel;

use App\Kernel\View\View;

class Controller
{
    private View $view;

    public function setView(View $view)
    {
        $this->view = $view;
    }
}
