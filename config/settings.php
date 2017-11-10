<?php
$config = [
    'settings' => [
        'displayErrorDetails' => true,
        'addContentLengthHeader' => false,
        'debug'=>true,
//        'logger' => [
//            'name' => 'slim-app',
//            'level' => Monolog\Logger::DEBUG,
//            'path' => __DIR__ . '/../logs/app.log',
//        ],
        'db' => [
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'cafesaba',
            'username' => 'root',
            'password' => 'root',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ],
        'view' => [
            'path' 	 => '../app/View',
        ],

    ],

];

?>
