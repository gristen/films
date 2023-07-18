<?php

namespace app\controllers;

use app\Views\Views;

class Controller
{

    public $view;

    function __construct()
    {
        $this->view = new Views();

    }

}