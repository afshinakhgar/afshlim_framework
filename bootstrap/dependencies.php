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

// not found handler
$container['notFoundHandler'] = function ($container) {
    return function (\Slim\Http\Request $request, \Slim\Http\Response $response) use ($container) {
        return $container['view']->render($response->withStatus(404), '404');
    };
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


//
//$container['session'] = function ($container)  {
//    $setting_session_driver = $container['settings']['session']['driver'] ?? 'session';
//
//    $session = new \Core\Services\Session($setting_session_driver);
//    return $session;
//};

$setting_session_driver = $container['settings']['session']['driver'] ?? 'session';

$sessionOBJ = new \Core\Services\Session($setting_session_driver);
$session = $sessionOBJ->init('session') ;




// Register Blade View helper
$container['view'] = function ($container) {
    $messages = $container->flash->getMessages();

    $viewSettings = $container['settings']['view'];

    return new \Slim\Views\Blade(
        [$viewSettings['blade_template_path'].$viewSettings['template']],
        $viewSettings['blade_cache_path'],
        null,
        [
            'translator'=> $container['translator'],
            'messages'=> $messages,
            'settings'  => $container->settings
        ]
    );
};
$app->getContainer()['view']->getRenderer()->getCompiler()->directive('helloWorld', function(){

    return "<?php echo 'Hello Directive'; ?>";
});



$GLOBALS['container'] = $container;
$GLOBALS['app'] = $app;




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

