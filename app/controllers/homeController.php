<?php

namespace app\controllers;



use app\Services\DB;

class homeController extends Controller
{


    public function action()
    {
        $db = new DB;
        $q = $db->pdo->prepare("SELECT * FROM film");
        $q->execute();
        $films = $q->fetchAll(\PDO::FETCH_ASSOC);


        $this->view->generate("home.php",[
            'films'=>$films,
        ]);


    }
}