<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit3561bb063ba06992911f890805c7d7f0
{
    public static $files = [
        '6e3fae29631ef280660b3cdad06f25a8' => __DIR__.'/..'.'/symfony/deprecation-contracts/function.php',
        '0e6d7bf4a5811bfa5cf40c5ccd6fae6a' => __DIR__.'/..'.'/symfony/polyfill-mbstring/bootstrap.php',
        '667aeda72477189d0494fecd327c3641' => __DIR__.'/..'.'/symfony/var-dumper/Resources/functions/dump.php',
    ];

    public static $prefixLengthsPsr4 = [
        'S' => [
            'Symfony\\Polyfill\\Mbstring\\' => 26,
            'Symfony\\Component\\VarDumper\\' => 28,
        ],
        'D' => [
            'Database\\Seeders\\' => 17,
            'Database\\Factories\\' => 19,
        ],
        'A' => [
            'App\\Kernel\\' => 11,
            'App\\' => 4,
        ],
    ];

    public static $prefixDirsPsr4 = [
        'Symfony\\Polyfill\\Mbstring\\' => [
            0 => __DIR__.'/..'.'/symfony/polyfill-mbstring',
        ],
        'Symfony\\Component\\VarDumper\\' => [
            0 => __DIR__.'/..'.'/symfony/var-dumper',
        ],
        'Database\\Seeders\\' => [
            0 => __DIR__.'/..'.'/laravel/pint/database/seeders',
        ],
        'Database\\Factories\\' => [
            0 => __DIR__.'/..'.'/laravel/pint/database/factories',
        ],
        'App\\Kernel\\' => [
            0 => __DIR__.'/../..'.'/Kernel',
        ],
        'App\\' => [
            0 => __DIR__.'/../..'.'/src',
            1 => __DIR__.'/..'.'/laravel/pint/app',
        ],
    ];

    public static $classMap = [
        'Composer\\InstalledVersions' => __DIR__.'/..'.'/composer/InstalledVersions.php',
    ];

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit3561bb063ba06992911f890805c7d7f0::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit3561bb063ba06992911f890805c7d7f0::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit3561bb063ba06992911f890805c7d7f0::$classMap;

        }, null, ClassLoader::class);
    }
}
