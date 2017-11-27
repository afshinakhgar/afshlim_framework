<?php
define('__APP_ROOT__',__DIR__ . '/../') ;

require  __APP_ROOT__.'bootstrap/bootstrap.php';
require  __APP_ROOT__.'core/Functions/helpers.php';
require __APP_ROOT__.'vendor/autoload.php';
require __APP_ROOT__.'config/settings.php';


if($settings['debug'] == true) {

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

$app = new \Core\App($config);

use SlimFacades\Facade;
// get container app
require __APP_ROOT__.'bootstrap/dependencies.php';
require  __APP_ROOT__.'bootstrap/routes.php';

if(php_sapi_name() != 'cli') {
    $settings['tracy']['path'] = '';
    if($app->getContainer() instanceof Psr\Container\ContainerInterface){
        $settings = $app->getContainer()->settings;
        if($settings['debug'] == true){
            Tracy\Debugger::enable(Tracy\Debugger::DEVELOPMENT, $settings['tracy']['path']);
        }
        Facade::setFacadeApplication($app);
    }

    require  __APP_ROOT__.'bootstrap/middlewares.php';

    $app->run();

}

