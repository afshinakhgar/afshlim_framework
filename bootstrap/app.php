<?php
define('__APP_ROOT__',__DIR__ . '/../') ;
require  __APP_ROOT__.'bootstrap/bootstrap.php';
require __APP_ROOT__.'vendor/autoload.php';

$env = new \Core\Helpers\Env();
defined('DS') || define('DS', DIRECTORY_SEPARATOR);

/*Dynamic containers in services*/
$config_dir = scandir(__APP_ROOT__.'/config/');
$ex_config_folders = array('..', '.');
$filesInConfig =  array_diff($config_dir,$ex_config_folders);
if (!isset($configs)) {
    $configs = array();
}
$i=0;
foreach($filesInConfig as $config_file){
	if($config_file === 'phpmig.php'){continue;}
	$file[$i] = include_once  __APP_ROOT__.'config/'.$config_file;
	if(is_array($file[$i])){
		$configs = array_merge($configs, $file[$i]);
		$i++;
	}

}

$config['settings'] = $configs;
require  __APP_ROOT__.'core/Functions/general_helpers.php';

$app = new \Core\App($config);
if($config['settings']['app']['debug'] && !$config['settings']['tracy']['active']){
    error_reporting(-1);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
}


use SlimFacades\Facade;
// get container app
require __APP_ROOT__.'bootstrap/dependencies.php';
require  __APP_ROOT__.'bootstrap/routes.php';
require  __APP_ROOT__.'core/Functions/helpers.php';
if(php_sapi_name() != 'cli') {
    if($config['settings']['app']['debug'] && (int)$config['settings']['tracy']['active']){
        Tracy\Debugger::enable(Tracy\Debugger::DEVELOPMENT, $config['settings']['tracy']['path']);
    }
    Facade::setFacadeApplication($app);

    require  __APP_ROOT__.'bootstrap/middlewares.php';

    $app->run();

}

