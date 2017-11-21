<?php
session_start();
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
define("PATH_ROOT", __DIR__ . '/../');


require  'bootstrap.php';
require '../vendor/autoload.php';


use \Slim\App;
require '../config/settings.php';
$app = new App($config);



use Core\Facade\Facade;
Facade::setFacadeApplication($app);
Facade::registerAliases();

// now you can start using the facades

Config::set('debug', true);


use Tracy\Debugger;
Debugger::enable(Debugger::DEVELOPMENT, __APP_ROOT__ . 'logs/debugger');



require  'middlewares.php';

// get container app
require 'dependencies.php';
require  'routes.php';



$app->run();

