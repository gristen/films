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
        // Получаем номер страницы из параметра Pagid или устанавливаем значение по умолчанию равным 1
        $pageNum = $this->request()->input('Pagid') ? (int)$this->request()->input('Pagid') : 1;

        $result = $this->db()->query('SELECT MONTH(create_at) AS month, COUNT(*) AS user_count
        FROM users
        WHERE create_at >= DATE_SUB(NOW(), INTERVAL 1 YEAR)
        GROUP BY MONTH(create_at)');

        $res = $this->service()->getRegUser($result);

        // Получаем массив пользователей для текущей страницы
        $users = $this->service()->getPage($pageNum, 3);

        // Получаем общее количество страниц
        $pagesCount = $this->service()->getPagesCount(3);

        // Получаем общее количество пользователей
        $userCount = count($users);

        // В контроллере admin()
        $this->view('/admin/users/index', [
            'users' => $users,
            'months' => $res['months'],
            'userCount' => $userCount, // Передаем общее количество пользователей
            'pagesCount' => $pagesCount,
            'currentPageNum' => $pageNum,
        ]);
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
