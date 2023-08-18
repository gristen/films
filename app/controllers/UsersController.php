<?php

namespace app\controllers;


use app\Models\Users\UsersModel;
use app\Exceptions\InvalidArgumentException;

class UsersController extends Controller
{
    public function singUP()
    {
        if (!empty($_POST)) {
            try {
                $user = UsersModel::signUP($_POST);
                var_dump($user);
            } catch (InvalidArgumentException $e) {
                $this->view->generate('users/register.php', ['error' => $e->getMessage()]);
                return;
            }
//
//            if ($user instanceof UsersModel) {
//                $this->view->generate('users/signSuccessful.php');
//                return;
//            }
        }

        $this->view->generate('users/register.php');
    }
}