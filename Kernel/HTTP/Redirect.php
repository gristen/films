<?php

namespace App\Kernel\HTTP;

class Redirect
{
    public function to(string $url)
    {
        header("Location:$url");
        exit();
    }
}
