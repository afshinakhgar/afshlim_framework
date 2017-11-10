<?php
use App\Controller\HomeController;

$app->get('/', HomeController::class.':index');

