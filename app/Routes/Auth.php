<?php
$route->get('/register[/{params:.*}]', \App\Controller\User\AuthController::class.':get_register_Action')->setName('register');
$route->post('/register', \App\Controller\User\AuthController::class.':post_register_Action')->setName('register');
$route->get('/login', \App\Controller\User\AuthController::class.':get_login_step1_Action')->setName('login.step1');
$route->post('/login', \App\Controller\User\AuthController::class.':post_login_step1_Action')->setName('login.step1');


