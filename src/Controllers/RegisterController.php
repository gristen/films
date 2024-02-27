<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;
use App\Services\UserService;

class RegisterController extends Controller
{
    private UserService $service;

    public function index(): void
    {
        $this->view('register', [], 'Регистрация');
    }

    public function register(): void
    {
        $validation = $this->request()->validate([
            'name' => ['required', 'max:255','findUsername'],
            'email' => ['required', 'email','findEmail'],
            'password' => ['required', 'min:3'],
            'password_confirmation' => ['required', 'min:3'],

        ]);

        if (! $validation) {
            foreach ($this->request()->errors() as $field => $errors) {
                $this->session()->set($field, $errors);
            }

            $this->redirect('/register');
        }

        $this->service()->store(
            $this->request()->input('name'),
            $this->request()->input('email'),
            password_hash($this->request()->input('password'), PASSWORD_DEFAULT),
        );

        $this->redirect('/');
    }

    public function service(): UserService
    {
        if (! isset($this->service)) {
            $this->service = new UserService($this->db());
        }

        return $this->service;
    }
}
