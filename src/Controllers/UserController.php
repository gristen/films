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

        $result = $this->db()->query('SELECT MONTH(create_at) AS month, COUNT(*) AS user_count
                FROM users
                WHERE create_at >= DATE_SUB(NOW(), INTERVAL 1 YEAR)
                GROUP BY MONTH(create_at)');

           $res = $this->service()->getRegUser($result);

        $this->view('/admin/users/index', ['users' => $this->service()->getUsers(),'months'=>$res['months'],'userCount'=>$res['userCount']], 'Админ панель');
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
