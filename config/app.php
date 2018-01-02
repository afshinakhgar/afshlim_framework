<?php
return  [
    'determineRouteBeforeAppMiddleware' => true,
    'addContentLengthHeader' => true,
    'displayErrorDetails' => true,
    'app' => [
        'log_timer' => true,
        'debug'=>true ,
        'image' => [
            'dir' =>  __APP_ROOT__ . 'public/uploads'
        ],
        'translation' => [
            'default_lang' => 'en',
            'translations_path' => __APP_ROOT__ . 'translations/',
        ],
        'auth' => [
            '2step' => true
        ],
        'logger' => [
            'name' => 'cafesaba',
            'level' => Monolog\Logger::DEBUG,
            'path' => __DIR__ . '/../storage/logs/app.log',
        ],
        'paging' => [
            'perpage' => '20',
        ],


    ],

];

