<?php
use App\Controller\HomeController;
$app->post('/console', 'RunTracy\Controllers\RunTracyConsole:index');

$app->get('/', HomeController::class.':index');
$app->get('/register[/{params:.*}]', \App\Controller\AuthController::class.':get_register_Action');

