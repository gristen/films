<?php

namespace App\Kernel\Controller;

use App\Kernel\HTTP\Request;
use App\Kernel\View\View;

abstract class Controller
{
    private View $view;

    private Request $request;

    public function view(string $name): void
    {

        $this->view->page($name);

    }

    public function request(): Request
    {
        return $this->request;
    }

    public function setView(View $view): void
    {
        $this->view = $view;
    }

    public function setRequest(Request $request): void
    {
        $this->request = $request;
    }
}
