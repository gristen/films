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
        $service->insert($this->request()->input('name'));
        $this->redirect('/admin');
    }
}
