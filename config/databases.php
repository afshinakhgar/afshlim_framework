<?php
return [
    'databases'=>[
        'db' => [
            'driver'    => $env(__APP_ROOT__,'DB_DRIVER', 'mysql'),
            'host'      => $env(__APP_ROOT__,'DB_HOST', 'localhost'),
            'database'  => $env(__APP_ROOT__,'DB_NAME', 'cafesaba'),
            'username'  => $env(__APP_ROOT__,'DB_USERNAME', 'root'),
            'password'  => $env(__APP_ROOT__,'DB_PASS', ''),
            'charset'   => $env(__APP_ROOT__,'DB_CHARSET', 'utf8'),
            'collation' => $env(__APP_ROOT__,'DB_COLLATION', 'utf8_unicode_ci'),
            'prefix'    => $env(__APP_ROOT__,'DB_PREFIX', ''),
            'port'      => $env(__APP_ROOT__,'DB_PORT', 3306),
        ],
    ]
];