<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;
use App\Services\CategoryService;
use App\Services\MoviesService;

class MovieController extends Controller
{
    private MoviesService $service;

    public function create(): void
    {
        $categories = new CategoryService($this->db());

        $this->view('admin/movies/add', ['categories' => $categories->all()]);
    }

    public function add(): void
    {
        $this->view('admin/movies/add');
    }

    public function store(): void
    {

        $validation = $this->request()->validate(
            [
                'name' => ['required', 'min:3', 'max:255'],
            ]
        );

        if (! $validation) {
            foreach ($this->request()->errors() as $field => $error) {

                $this->session()->set($field, $error);
            }

        }

        $this->service()->store(
            $this->request()->input('name'),
            $this->request()->input('description'),
            $this->request()->file('image'),
            intval($this->request()->input('category')),
        );
        $this->redirect('/admin');
    }

    public function service(): MoviesService
    {
        if (! isset($this->service)) {
            $this->service = new MoviesService($this->db());
        }

        return $this->service;
    }
}
