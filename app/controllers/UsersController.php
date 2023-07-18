<?php

namespace app\controllers;


use app\Models\Users\UsersModel;
use app\Exceptions\InvalidArgumentException;

class UsersController extends Controller
{

    public function index_register()
    {
        $this->view->generate("register.php");

    }


    public  function signUP()
    {
        if (!empty($_POST))
        {
            try
            {
              $user = UsersModel::sign($_POST,$_FILES);
            }catch (InvalidArgumentException $e)
            {
                $this->view->generate('register.php', ['error' => $e->getMessage()]);
                return;
            }

        }
        $this->view->generate("register.php");


    }



}
