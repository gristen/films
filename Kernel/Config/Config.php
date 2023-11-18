<?php

namespace App\Kernel\Config;

class Config implements ConfigInterface
{
    public function get(string $key, $default = null)
    {
        [$file,$key] = explode('.', $key);

        $configPath = APP_PATH."/config/$file.php";

        if (! $configPath) {
            return $default;
        }

        $config = require $configPath;

        return $config[$key] ?? $default;

    }
}
