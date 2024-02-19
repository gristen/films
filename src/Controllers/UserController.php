<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;
use App\Services\CategoryService;
use App\Services\UserService;

class UserController extends Controller
{
    public function favorites(): void
    {

        $this->db()->insert('favorites', ['user_id' => $this->request()->input('user_id'), 'film_id' => $this->request()->input('movie_id')]);

    }

    public function favoritesDestroy(): void
    {

        $this->db()->delete('favorites', ['user_id' => $this->request()->input('user_id'), 'film_id' => $this->request()->input('movie_id')]);

        var_dump($this->request()->input('user_id'));
    }

    public function admin(): void
    {

        $this->view('/admin/users/index', ['users' => $this->service()->getUsers()], 'Админ панель');
    }


    public function edit(): void
    {
        $this->view('admin/users/update', [
            'user' => $this->service()->find($this->request()->input('id')),

        ]);
    }

    public function update():void
    {

        $this->service()->update($this->request()->input('id'),$this->request()->input('name'),$this->request()->file('image'));
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
