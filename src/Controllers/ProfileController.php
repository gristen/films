<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;
use App\Services\MoviesService;
use App\Services\UserService;

class ProfileController extends Controller
{
    private UserService $service;

    public function index(): void
    {
        $userId = $this->request()->input('id');
        $favorites = $this->service()->getFavoritesMovies($this->auth()->id());

        $user = $this->service()->find($userId);

        $this->view('profile', ['user' => $user, 'favorites' => $favorites]);

    }

    public function service(): UserService
    {
        $moviesService = new MoviesService($this->db());
        if (! isset($this->service)) {
            $this->service = new UserService($this->db(), $moviesService);
        }

        return $this->service;
    }
}
