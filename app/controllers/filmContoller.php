<?php

namespace app\controllers;

use app\Models\Films\Film;
use app\Models\Users\UsersModel;
use app\Services\DB;
use app\Services\Logger;

class filmContoller extends Controller
{
    public function view(int $filmId)
    {

        $film = Film::getById($filmId);

        if ($film === null)
        {
            $this->view->generate('404.php',[],404);
            return;
        }

      //  $filmAuthor = UsersModel::getById($film->getAuthorId()); // передает в метод название бд users , а в скобочках уже какой пользователь нужен , т.е id authora

       $this->view->generate('film.php',[
           "film"=>$film,
          // "author"=>$filmAuthor,
       ]);
    }
}