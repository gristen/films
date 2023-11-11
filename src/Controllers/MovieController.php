<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;
use App\Kernel\Validator\Validator;

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
        $data = ['name' => ''];
        $rules = ['name' => ['required', 'min:3', 'max:10']];

        $validator = new Validator();
        dd($validator->validate($data, $rules));
        //  $this->request()->input('name');
    }
}
