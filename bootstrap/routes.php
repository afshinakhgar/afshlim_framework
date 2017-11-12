<?php
use App\Controller\HomeController;
$app->post('/console', 'RunTracy\Controllers\RunTracyConsole:index');

$app->get('/', HomeController::class.':index');

