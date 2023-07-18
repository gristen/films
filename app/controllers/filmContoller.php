<?php

namespace app\controllers;

use app\Services\DB;

class filmContoller extends Controller
{


    public function view(int $filmId)
    {
        $db = new DB();
        $q = $db->pdo->prepare("SELECT * FROM films WHERE id = :id;");
        $q->execute([
            "id"=>$filmId,
        ]);
        $res = $q->fetchAll(\PDO::FETCH_ASSOC);


       $this->view->generate('film.php',[
           "film"=>$res[0],
       ]);

    }
}