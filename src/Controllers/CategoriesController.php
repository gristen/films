<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;

class CategoriesController extends Controller
{
    public function create(): void
    {
        $this->view('admin/categories/add');
    }

    public function destroy()
    {

    }
}
