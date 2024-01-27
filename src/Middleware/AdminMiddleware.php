<?php

namespace App\Middleware;

use App\Kernel\Midleware\AbstractMiddleware;

class AdminMiddleware extends AbstractMiddleware
{
    public function handle(): void
    {
        if (! $this->auth->isAdmin()) {
            $this->redirect->to('/home');
        }
    }
}
