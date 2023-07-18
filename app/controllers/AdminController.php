<?php

namespace app\controllers;

class AdminController extends Controller
{
    public function action()
    {
        $this->view->generate("adminpanel.php",[

        ]);
    }
}