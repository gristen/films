<?php

namespace app\controllers;

use app\Services\DB;
use app\Views\Views;

class Controller
{

    public $view;
    public $db;

    function __construct()
    {
        $this->view = new Views();
        $this->db = new DB;

    }

}