<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;
use App\Services\UserService;

class RegisterController extends Controller
{
    private UserService $service;

    public function index(): void
    {
        $this->view('register');
    }

    public function register(): void
    {
        $validation = $this->request()->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8'],
            'password_confirmation' => ['required', 'min:8'],
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
            $this->request()->file('avatar'),
            password_hash($this->request()->input('password'), PASSWORD_DEFAULT),
        );

        /*$this->db()->insert('users', [
            'name' => $this->request()->input('name'),
            'email' => $this->request()->input('email'),
            'password' => password_hash($this->request()->input('password'), PASSWORD_DEFAULT),
        ]);*/

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
