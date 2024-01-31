<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;
use App\Services\UserService;

class ProfileController extends Controller
{
    private UserService $service;

    public function index(): void
    {

        $user = $this->view('profile', ['user' => $this->service()->find($this->request()->input('id'))]);
        dd($user);
    }

    public function service(): UserService
    {
        if (! isset($this->service)) {
            $this->service = new UserService($this->db());
        }

        return $this->service;
    }
}
