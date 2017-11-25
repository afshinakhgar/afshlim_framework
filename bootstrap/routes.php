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

$route = new \Core\Route($app);
$route->resource('/user/auth', '\App\Controller\User\AuthController', $args = []);


$route->post('/console', 'RunTracy\Controllers\RunTracyConsole:index');
$route->get('/', HomeController::class.':index');
$route->get('/register[/{params:.*}]', \App\Controller\User\AuthController::class.':get_register_Action');
$route->post('/register', \App\Controller\User\AuthController::class.':post_register_Action');
$route->get('/login', \App\Controller\User\AuthController::class.':get_login_Action');
$route->post('/login', \App\Controller\User\AuthController::class.':post_login_Action');

