<?php

namespace app\Services;

class Page
{
    public static function part($part_name)
    {
        //require_once "public/components/".$part_name . ".php";
        require_once $_SERVER['DOCUMENT_ROOT']."/public/components/".$part_name . ".php";
    }
}