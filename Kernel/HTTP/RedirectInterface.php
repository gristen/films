<?php

namespace App\Kernel\HTTP;

interface RedirectInterface
{
    public function to(string $url);
}
