<?php

namespace App\Kernel\Midleware;

use App\Kernel\auth\AuthInterface;
use App\Kernel\HTTP\RedirectInterface;
use App\Kernel\HTTP\RequestInterface;

abstract class AbstractMiddleware
{
    public function __construct(
        protected RequestInterface $request,
        protected AuthInterface $auth,
        protected RedirectInterface $redirect,
    ) {

    }

    abstract public function handle(): void;
}
