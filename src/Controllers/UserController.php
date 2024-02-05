<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;
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
        echo 'delete';

    }

    public function showFavorites(): void
    {
        $this->service()->getFavoritesMovies($this->auth()->id());
    }

    public function service(): UserService
    {
        if (! isset($this->service)) {
            $this->service = new UserService($this->db());
        }

        return $this->service;
    }
}