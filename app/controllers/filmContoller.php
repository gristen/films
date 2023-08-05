<?php

namespace app\controllers;

use app\Services\DB;
use app\Services\Logger;

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

        if ($res === [])
        {
            $this->view->generate('404.php',[],404);
            return;
        }
       $this->view->generate('film.php',[
           "film"=>$res[0],
       ]);

        var_dump($res);


    }
}