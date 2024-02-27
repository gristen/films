<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;
use App\Services\MoviesService;

class NewController extends Controller
{
    public function index(): void
    {
        $movies = new MoviesService($this->db());

        $this->view('new', [
            'movies' => $movies->newMovies(),
        ], 'Главная страница');

    }
}
