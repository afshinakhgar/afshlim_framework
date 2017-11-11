<?php

$APPROOT =  __DIR__ . '/../';
use Core\Helpers\EnvHelper;
$env = new EnvHelper();

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
            'driver' => $env($APPROOT,'DB_DRIVER', 'mysql'),
            'host' => $env($APPROOT,'DB_HOST', 'localhost'),
            'database' => $env($APPROOT,'DB_NAME', 'cafesaba'),
            'username' => $env($APPROOT,'DB_USERNAME', 'root'),
            'password' => $env($APPROOT,'DB_PASS', 'root'),
            'charset'   => $env($APPROOT,'DB_CHARSET', 'utf8'),
            'collation' => $env($APPROOT,'DB_COLLATION', 'utf8_unicode_ci'),
            'prefix'    => $env($APPROOT,'DB_PREFIX', ''),
        ],
        'view' => [
            'path' 	 => '../app/View',
        ],

    ],

];

?>
