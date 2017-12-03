<?php
define('__APP_ROOT__',__DIR__ . '/../') ;
require  __APP_ROOT__.'bootstrap/bootstrap.php';
require __APP_ROOT__.'vendor/autoload.php';
require __APP_ROOT__.'config/settings.php';

require  __APP_ROOT__.'core/Functions/general_helpers.php';


$app = new \Core\App($config);

if($config['settings']['debug'] && !$config['settings']['tracy']['active']){
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}


use SlimFacades\Facade;
// get container app
require __APP_ROOT__.'bootstrap/dependencies.php';

require  __APP_ROOT__.'bootstrap/routes.php';
require  __APP_ROOT__.'core/Functions/helpers.php';

if(php_sapi_name() != 'cli') {
    if($config['settings']['debug'] && $config['settings']['tracy']['active']){
        Tracy\Debugger::enable(Tracy\Debugger::DEVELOPMENT, $config['settings']['tracy']['path']);
    }
    Facade::setFacadeApplication($app);

    require  __APP_ROOT__.'bootstrap/middlewares.php';

    $app->run();

}

