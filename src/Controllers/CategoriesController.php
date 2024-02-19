<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;
use App\Services\CategoryService;

class CategoriesController extends Controller
{
    public function create(): void
    {
        $this->view('admin/categories/add');
    }

    public function category():void
    {
        $filter = $this->request()->input('filter');


        $this->view('/categories/category',['movies'=>$this->service()->getCategory($filter)]);

    }

    public function index():void
    {
        $this->view('/categories/index',['categories'=>$this->service()->all()],'Жанры');
    }
    public function update(): void
    {

        $validation = $this->request()->validate([
            'name' => ['required'],
        ]);
        if (! $validation) {
            foreach ($this->request()->errors() as $field => $errors) {
                $this->session()->set($field, $errors);
            }

            $this->redirect("/admin/categories/update?id={$this->request()->input('id')}");
        }

        $service = new CategoryService($this->db());
        $service->update(
            $this->request()->input('id'),
            $this->request()->input('name'),
        );

        $this->redirect('/admin');
    }

    public function edit(): void
    {
        $service = new CategoryService($this->db());

        $category = $service->find($this->request()->input('id'));

        $this->view('admin/categories/update', ['category' => $category]);
    }

    public function destroy(): void
    {
        $service = new CategoryService($this->db());
        $service->delete($this->request()->input('id'));
        $this->redirect('/admin');
    }

    public function store(): void
    {
        $service = new CategoryService($this->db());
        $validation = $this->request()->validate([
            'name' => ['required'],
        ]);
        if (! $validation) {
            foreach ($this->request()->errors() as $field => $errors) {
                $this->session()->set($field, $errors);
            }

            $this->redirect('/admin/categories/add');
        }

        $service->insert($this->request()->input('name'),$this->request()->file('image'));
        $this->redirect('/admin');
    }


    public function service(): CategoryService
    {
        if (! isset($this->service)) {
            $this->service = new CategoryService($this->db());
        }

        return $this->service;
    }
}
