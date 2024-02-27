<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;

class LoginController extends Controller
{
    public function index(): void
    {
        $this->view('login');

    }

    public function login(): void
    {
        $email = $this->request()->input('email');
        $password = $this->request()->input('password');

       if ( $this->auth()->attempt($email, $password) === false){
           $this->session()->set('error','Введенные вами данные не верны');
           $this->redirect("/login");
       }

        $this->redirect('/home');
    }

    public function logout(): void
    {
        $this->auth()->logout();

        $this->redirect('/login');
    }
}
