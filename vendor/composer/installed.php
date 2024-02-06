<?php

return [
    'root' => [
        'name' => '__root__',
        'pretty_version' => 'dev-main',
        'version' => 'dev-main',
        'reference' => '8ad8b76c13d560bd3b95085c03ee134c7f7fde06',
        'type' => 'library',
        'install_path' => __DIR__.'/../../',
        'aliases' => [],
        'dev' => true,
    ],
    'versions' => [
        '__root__' => [
            'pretty_version' => 'dev-main',
            'version' => 'dev-main',
            'reference' => '8ad8b76c13d560bd3b95085c03ee134c7f7fde06',
            'type' => 'library',
            'install_path' => __DIR__.'/../../',
            'aliases' => [],
            'dev_requirement' => false,
        ],
        'laravel/pint' => [
            'pretty_version' => 'v1.13.10',
            'version' => '1.13.10.0',
            'reference' => 'e2b5060885694ca30ac008c05dc9d47f10ed1abf',
            'type' => 'project',
            'install_path' => __DIR__.'/../laravel/pint',
            'aliases' => [],
            'dev_requirement' => true,
        ],
        'symfony/deprecation-contracts' => [
            'pretty_version' => 'v3.4.0',
            'version' => '3.4.0.0',
            'reference' => '7c3aff79d10325257a001fcf92d991f24fc967cf',
            'type' => 'library',
            'install_path' => __DIR__.'/../symfony/deprecation-contracts',
            'aliases' => [],
            'dev_requirement' => true,
        ],
        'symfony/polyfill-mbstring' => [
            'pretty_version' => 'v1.29.0',
            'version' => '1.29.0.0',
            'reference' => '9773676c8a1bb1f8d4340a62efe641cf76eda7ec',
            'type' => 'library',
            'install_path' => __DIR__.'/../symfony/polyfill-mbstring',
            'aliases' => [],
            'dev_requirement' => true,
        ],
        'symfony/var-dumper' => [
            'pretty_version' => 'v6.4.3',
            'version' => '6.4.3.0',
            'reference' => '0435a08f69125535336177c29d56af3abc1f69da',
            'type' => 'library',
            'install_path' => __DIR__.'/../symfony/var-dumper',
            'aliases' => [],
            'dev_requirement' => true,
        ],
    ],
];
