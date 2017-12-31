<?php
$config = [
    'app' => [
        'log_timer' => true,
        'displayErrorDetails' => true,
        'addContentLengthHeader' => true,
        'determineRouteBeforeAppMiddleware' => true,
        'debug'=>true ,
        'image' => [
            'dir' =>  $APPROOT . '/public/uploads'
        ],
        'translation' => [
            'default_lang' => 'en',
            'translations_path' => $APPROOT . 'translations/',
        ],
        'auth' => [
            '2step' => true
        ],
        'logger' => [
            'name' => 'cafesaba',
            'level' => Monolog\Logger::DEBUG,
            'path' => __DIR__ . '/../storage/logs/app.log',
        ],
        
        
    ],

];

return $config;
