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


$route->get('/', HomeController::class.':index')->setName('home');
$route->get('/register[/{params:.*}]', \App\Controller\User\AuthController::class.':get_register_Action')->setName('register');
$route->post('/register', \App\Controller\User\AuthController::class.':post_register_Action')->setName('register');
$route->get('/login', \App\Controller\User\AuthController::class.':get_login_Action')->setName('login');
$route->post('/login', \App\Controller\User\AuthController::class.':post_login_Action')->setName('login');
$route->resource('/user/auth', '\App\Controller\User\AuthController', $args = []);

