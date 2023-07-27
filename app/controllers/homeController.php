<?php

namespace app\controllers;



use app\Models\Films\Film;
use app\Services\DB;

class homeController extends Controller
{

    public function action()
    {
        $films = Film::findAll();
      $this->view->generate("home.php",['films'=>$films]);


    }
}