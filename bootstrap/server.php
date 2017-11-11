<?php
session_start();
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
require '../vendor/autoload.php';

define("PATH_ROOT", __DIR__ . '/../');


use \Slim\App;
require '../config/settings.php';
$app = new App($config);

// get container app
require 'dependencies.php';
require  'routes.php';



$app->run();

