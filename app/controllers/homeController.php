<?php

namespace app\controllers;



use app\Models\Films\Film;
use app\Services\DB;
use app\Services\Logger;

class homeController extends Controller
{

    public function action()
    {
        $films = Film::findAll();
        Logger::logRequest(['test-message']);
      $this->view->generate("home.php",['films'=>$films]);



    }
}