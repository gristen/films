<?php

namespace App\Kernel\HTTP;

class Redirect implements RedirectInterface
{
    public function to(string $url)
    {
        header("Location:$url");
        exit();
    }
}
