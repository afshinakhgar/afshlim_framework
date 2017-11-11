<?php
$config = [
    'settings' => [
        'displayErrorDetails' => true,
        'addContentLengthHeader' => false,
        'debug'=>true,
        'logger' => [
            'name' => 'afshFramework',
            'level' => Monolog\Logger::DEBUG,
            'path' => __DIR__ . '/../logs/app.log',
        ],
        'db' => [
            'driver' => $env(PATH_ROOT,'DB_DRIVER', 'mysql'),
            'host' => $env(PATH_ROOT,'DB_HOST', 'localhost'),
            'database' => $env(PATH_ROOT,'DB_NAME', 'cafesaba'),
            'username' => $env(PATH_ROOT,'DB_USERNAME', 'root'),
            'password' => $env(PATH_ROOT,'DB_PASS', 'root'),
            'charset'   => $env(PATH_ROOT,'DB_CHARSET', 'utf8'),
            'collation' => $env(PATH_ROOT,'DB_COLLATION', 'utf8_unicode_ci'),
            'prefix'    => $env(PATH_ROOT,'DB_PREFIX', ''),
        ],
        'view' => [
            'path' 	 => '../app/View',
        ],

    ],

];

?>
