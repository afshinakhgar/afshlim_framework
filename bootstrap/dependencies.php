<?php


$container = $app->getContainer();

/* database connection */
$container['db'] = function ($container) {
    $db = $container['settings']['db'];
    $pdo = new PDO("mysql:host=" . $db['host'] . ";dbname=" . $db['dbname'],
        $db['user'], $db['pass']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
};

// Service factory for the ORM


$container['eloquent'] = function ($container) {
    $capsule = new \Illuminate\Database\Capsule\Manager;
    $capsule->addConnection($container['settings']['db']);
    $capsule->setAsGlobal();
    $capsule->bootEloquent();
    return $capsule;
};


$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();
$container['db_eloquent'] = function ($container) {

    return $capsule;
};



// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};


//
//$container['view'] = function ($container) {
//
//    $view = $container['settings']['view'];
//
//    return new \Slim\Views\PhpRenderer($view['path']);
//};


// Register Blade View helper
$container['view'] = function ($container) {
    return new \Slim\Views\Blade(
        $container['settings']['renderer']['blade_template_path'],
        $container['settings']['renderer']['blade_cache_path']
    );
};


// Register provider
$container['flash'] = function () {
    return new \Slim\Flash\Messages();
};


$container['validator'] = function () {
    return new Awurth\SlimValidation\Validator();
};






$GLOBALS['container'] = $container;





return $container;

