<?php
session_start();

define("PATH_ROOT", __DIR__ . '/../');


require  'bootstrap.php';
require '../vendor/autoload.php';
use \Slim\App;
require '../config/settings.php';
$app = new App($config);


use SlimFacades\Facade;
use SlimFacades\Route;

Facade::setFacadeApplication($app);
$settings['tracy']['path'] = '';
if($app->getContainer() instanceof Psr\Container\ContainerInterface){
    $settings = $app->getContainer()->settings;
}


use Tracy\Debugger;
Debugger::enable(Debugger::DEVELOPMENT, $settings['tracy']['path']);



require  'middlewares.php';

// get container app
require 'dependencies.php';
require  'routes.php';



$app->run();

