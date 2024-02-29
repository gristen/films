<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;
use App\Services\CategoryService;
use App\Services\MoviesService;

class HomeController extends Controller
{

    public function index():void
    {

        $movies = new MoviesService($this->db());
        $categories = new CategoryService($this->db());

        $this->view('home', [
            'newMovies' => $movies->newMovies(),
            'bests' => $movies->getBestMovies(),
             'categories' =>$categories->all() ,
        ], 'Главная страница');

    }

}