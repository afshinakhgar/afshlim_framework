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
$container['db_el_orm'] = function ($container) {
    $capsule = new \Illuminate\Database\Capsule\Manager;
    $capsule->addConnection($container['settings']['db']);

    $capsule->setAsGlobal();
    $capsule->bootEloquent();

    return $capsule;
};



// Register provider
$container['flash'] = function () {
    return new \Slim\Flash\Messages();
};


$container['validator'] = function () {
    return new Awurth\SlimValidation\Validator();
};




$container['view'] = function ($container) {

    $view = $container['settings']['view'];

    return new PhpRenderer($view['path']);
};



$GLOBALS['container'] = $container;

return $container;

