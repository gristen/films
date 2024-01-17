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
            $this->redirect("movie?id={$this->request()->input('id')}");
        }

        $this->service()->store(
            $this->request()->input('name'),
            $this->request()->input('description'),
            $this->request()->file('image'),
            intval($this->request()->input('category')),
        );
        $this->redirect('/admin');
    }

    public function edit(): void
    {
        $categories = new CategoryService($this->db());
        $this->view('admin/movies/update', [
            'movie' => $this->service()->find($this->request()->input('id')),
            'categories' => $categories->all(),

        ]);
    }

    public function update(): void
    {

        $this->service()->update(
            $this->request()->input('id'),
            $this->request()->input('name'),
            $this->request()->input('description'),
            $this->request()->file('image'),
            $this->request()->input('category'),
        );
        $this->redirect('/admin');
    }

    public function destroy(): void
    {
        $this->service()->destroy($this->request()->input('id'));

        $this->redirect('/admin');
    }

    public function show(): void
    {
        $this->view('movie', ['movie' => $this->service()->find($this->request()->input('id'))]);
    }

    public function service(): MoviesService
    {
        if (! isset($this->service)) {
            $this->service = new MoviesService($this->db());
        }

        return $this->service;
    }
}
