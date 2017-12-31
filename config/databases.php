<?php

return [
    'databases'=>[
        'db' => [
            'driver'    => $env($APPROOT,'DB_DRIVER', 'mysql'),
            'host'      => $env($APPROOT,'DB_HOST', 'localhost'),
            'database'  => $env($APPROOT,'DB_NAME', 'cafesaba'),
            'username'  => $env($APPROOT,'DB_USERNAME', 'root'),
            'password'  => $env($APPROOT,'DB_PASS', 'root'),
            'charset'   => $env($APPROOT,'DB_CHARSET', 'utf8'),
            'collation' => $env($APPROOT,'DB_COLLATION', 'utf8_unicode_ci'),
            'prefix'    => $env($APPROOT,'DB_PREFIX', ''),
            'port'      => $env($APPROOT,'DB_PORT', 3306),
        ],
    ]
];