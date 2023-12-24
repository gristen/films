<?php

namespace App\Middleware;

use App\Kernel\Midleware\AbstractMiddleware;

class AuthMiddlewaire extends AbstractMiddleware
{
    public function handle(): void
    {
        if (! $this->auth->check()) {
            $this->redirect->to('/login');
        }
    }
}
