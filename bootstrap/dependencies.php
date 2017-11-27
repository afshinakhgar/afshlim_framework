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


$container['generalErrorHandler'] = function ($container) {
    return new \Core\Handlers\GeneralErrorHandler($container);
};



// Service factory for the ORM
$container['validator'] = function () {
    return new App\Validation\Validator();
};


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

    $messages = $container->flash->getMessages();

    $viewSettings = $container['settings']['view'];
    return new \Slim\Views\Blade(
        [$viewSettings['blade_template_path'].$viewSettings['template']],
        $viewSettings['blade_cache_path'],
        null,
        [
            'translator'=>$container['translator'],
            'messages'=> $messages
        ]
    );
};
//$app->getContainer()->get('blade')->get('global-var');
$translator = new \Core\Translator\Translator($container);
$translator->init();

$container['translator'] = function () use ($translator) {
    return $translator;
};


// Register provider
$container['flash'] = function () {
    return new \Slim\Flash\Messages();
};






$GLOBALS['container'] = $container;




/*Dynamic containers in services*/
$dir = scandir(__APP_ROOT__.'/core/Services/');
$ex_folders = array('..', '.');
$filesInServices =  array_diff($dir,$ex_folders);

foreach($filesInServices as $service){
    $content = preg_replace('/.php/','',$service);
    $container[$content] = function () use ($content){
        $class =  '\\Core\\Services\\'.$content ;
        return new $class();
    };
}


return $container;

