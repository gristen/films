<?php

namespace app\Services;

class Page
{
    public static function part($part_name)
    {
        //require_once "views/components/".$part_name . ".php";
        require_once $_SERVER['DOCUMENT_ROOT']."/views/components/".$part_name . ".php";
    }
}