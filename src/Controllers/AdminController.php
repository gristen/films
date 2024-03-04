<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;
use App\Services\CategoryService;
use App\Services\MoviesService;

class AdminController extends Controller
{
    public function index(): void
    {
        $categories = new CategoryService($this->db());
        $movies = new MoviesService($this->db());

        $this->view('admin', [
            'categories' => $categories->all(),
            'movies' => $movies->all(),
        ], 'Админ панель');
    }

    public function reviews(): void
    {
        $this->view('/admin/reviews/reviews');
    }
}
