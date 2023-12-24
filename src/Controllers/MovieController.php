<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;

class MovieController extends Controller
{
    public function index(): void
    {
        $this->view('movies');
    }

    public function add(): void
    {
        $this->view('admin/movies/add');
    }

    public function store()
    {
        $file = $this->request()->file('image');
        $filePath = $file->move('tset');
        $this->storage()->url($filePath);
        $validation = $this->request()->validate(
            [
                'name' => ['required', 'min:3', 'max:255'],
            ]
        );

        if (! $validation) {
            foreach ($this->request()->errors() as $field => $error) {

                $this->session()->set($field, $error);
            }

            $this->redirect();
        }
        $id = $this->db()->insert('movies', [
            'name' => $this->request()->input('name'), // name название коллонки в БД

        ]);

    }
}
