<?php

namespace app\controllers;

use app\Exceptions\NotFoundException;
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
           throw new  NotFoundException();
        }

      //  $filmAuthor = UsersModel::getById($film->getAuthorId()); // передает в метод название бд users , а в скобочках уже какой пользователь нужен , т.е id authora

       $this->view->generate('film.php',[
           "film"=>$film,
          // "author"=>$filmAuthor,
       ]);
    }
    public function edit(int $filmId):void
    {
            $film = Film::getById($filmId);

        if ($film === null)
        {
            $this->view->generate('404.php',[],404);
            return;
        }



            $film->save();
    }

    public function add():void
    {
//        $author = UsersModel::getById(1);
//        $film = new Film();
//        $film->setAuthor($author);
//        $film->setFilmPath("path");
//        $film->setText("text");
//        $film->setFilmPreviewPath("FilmPreviewPath");
//        $film->setHot(1);
//        $film->setName("nazvanie");
//         $film->save();
   // var_dump($film);
    }

    public function delete (int $id)
    {


        $article = Film::getById($id);
        if ($article) {
            $article->delete();
            echo ' Статья удалена';
        }



    }
}