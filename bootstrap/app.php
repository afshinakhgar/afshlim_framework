<?php
define('__APP_ROOT__',__DIR__ . '/../') ;

require  __APP_ROOT__.'bootstrap/bootstrap.php';
require __APP_ROOT__.'vendor/autoload.php';
require __APP_ROOT__.'config/settings.php';
$app = new \Core\App($config);


use SlimFacades\Facade;
use SlimFacades\Route;

Facade::setFacadeApplication($app);
$settings['tracy']['path'] = '';
if($app->getContainer() instanceof Psr\Container\ContainerInterface){
    $settings = $app->getContainer()->settings;
}


require  __APP_ROOT__.'bootstrap/middlewares.php';

// get container app
require __APP_ROOT__.'bootstrap/dependencies.php';
require  __APP_ROOT__.'bootstrap/routes.php';



$app->run();

