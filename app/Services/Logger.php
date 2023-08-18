<?php

namespace app\Services;

class Logger
{
    public  static function logRequest(array $message)
    {
        $logPath = "app/log/log.txt";
        $ipAddressUser=$_SERVER['REMOTE_ADDR'];
        $timestamp = date('Y-m-d H:i:s');

        file_put_contents($logPath,"[date]-> ". $timestamp . " [ip-address]-> ".$ipAddressUser . " [message]-> ".$message[0]. "\n" ,FILE_APPEND);
    }

}