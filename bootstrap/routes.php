<?php
use App\Controller\HomeController;

//
//$resourceFullRoutes = [
//    'get' => [
//        'index',
//        'one/{id:[0-9]}',
//        'edit/{id:[0-9]}',
//    ],
//    'delete'=> [
//        'delete'
//    ],
//    'post' => [
//        'store',
//    ],
//    'put' => [
//        'update'
//    ]
//
//];
//


$app->post('/console', 'RunTracy\Controllers\RunTracyConsole:index');

$app->get('/', HomeController::class.':index');
$app->get('/register[/{params:.*}]', \App\Controller\User\AuthController::class.':get_register_Action');
$app->post('/register', \App\Controller\User\AuthController::class.':post_register_Action');

