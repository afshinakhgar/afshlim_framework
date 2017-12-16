<?php
$route->get('/register[/{params:.*}]', \App\Controller\User\AuthController::class.':get_register_Action')->setName('register');
$route->post('/register', \App\Controller\User\AuthController::class.':post_register_Action')->setName('register');
$route->get('/login', \App\Controller\User\AuthController::class.':get_login_step1_Action')->setName('login.step1');
$route->get('/loginstep2[/{params:.*}]', \App\Controller\User\AuthController::class.':get_login_step2_Action')->setName('login.step2');
$route->post('/login', \App\Controller\User\AuthController::class.':post_login_step1_Action')->setName('login.step1');
$route->post('/loginstep2', \App\Controller\User\AuthController::class.':post_login_step2_Action')->setName('login.step2');
$route->get('/logout', \App\Controller\User\AuthController::class.':get_logout_Action')->setName('logout');


