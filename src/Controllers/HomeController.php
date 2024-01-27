<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;
use App\Services\MoviesService;

class HomeController extends Controller
{
    public function index(): void
    {
        $movies = new MoviesService($this->db());

        $this->view('home', [
            'movies' => $movies->newMovies(),
        ], 'Главная страница');

    }
}
