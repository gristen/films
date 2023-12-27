<?php

namespace App\Kernel\View;

class View
{
    public function page($namePage): void
    {
        require_once APP_PATH."/views/pages/$namePage.php";
    }
}
