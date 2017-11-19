<?php

use Illuminate\Database\Capsule\Manager as Capsule;
$container = $app->getContainer();

/* database connection */


$container['db'] = function ($container) {
    $db = $container['settings']['db'];
    $pdo = new PDO("mysql:host=" . $db['host'] . ";dbname=" . $db['database'],
        $db['username'], $db['password']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
};

//
//$container['translator'] = function (\Interop\Container\ContainerInterface $container) {
//    $translator = new \Core\TranslationHandler($container);
//    return $translator;
//};

//    $translation_conf = $container['settings']['translation'] ;
//    $loader = new \Illuminate\Translation\FileLoader(new \Illuminate\Filesystem\Filesystem(), $translation_conf['translations_path']);
//    // Register the Dutch translator (set to "en" for English)
//    $translator = new \Illuminate\Translation\Translator($loader, "fa");
//    dd($translator->trans('title'));

// Service factory for the ORM



$container['eloquent'] = function ($container) {
    $capsule = new \Illuminate\Database\Capsule\Manager;
    $capsule->addConnection($container['settings']['db']);
    $capsule->setAsGlobal();
    $capsule->bootEloquent();
    $capsule::connection()->enableQueryLog();

    return $capsule;
};

// database
$capsule = new Capsule;
$capsule->addConnection($config['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();


// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

// Register Blade View helper
$container['view'] = function ($container) {
    return new \Slim\Views\Blade(
        $container['settings']['view']['blade_template_path'].$container['settings']['view']['template'],
        $container['settings']['view']['blade_cache_path']
    );
};


// Register provider
$container['flash'] = function () {
    return new \Slim\Flash\Messages();
};






$GLOBALS['container'] = $container;





return $container;

