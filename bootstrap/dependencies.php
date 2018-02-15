<?php


use Illuminate\Database\Capsule\Manager as Capsule;
$container = $app->getContainer();

/* database connection */
$container['db'] = function ($container) {
    $db = $container['settings']['databases']['db'];
    $pdo = new PDO("mysql:host=" . $db['host'] . ";dbname=" . $db['database'],
        $db['username'], $db['password']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
};

$moduleInitializer = new \Core\ModuleInitializer($app, [
    'App\\Module\\Hello'
]);

$moduleInitializer->initModules();



// $container is application's DIC container.
// Setup Paginator resolvers
Illuminate\Pagination\Paginator::currentPageResolver(function ($pageName = 'page') use ($container) {

    $page = $container->request->getParam($pageName);
    if (filter_var($page, FILTER_VALIDATE_INT) !== false && (int) $page >= 1) {
        return $page;
    }
    return 1;
});


// $container['mailer'] = function ($container) {
//     $config = $container->settings['swiftmailer'];
//     $allowedTransportTypes = ['smtp', 'sendmail'];
//     if (false === $config['enable']
//         || !in_array($config['transport_type'], $allowedTransportTypes)
//     ) {
//         return false;
//     }
//     if ('smtp' === $config['transport_type']) {
//         $transport = new \Swift_SmtpTransport();
//     } elseif ('sendmail' === $config['transport_type']) {
//         $transport = new \Swift_SendmailTransport();
//     }
//     if (isset($config[$config['transport_type']])
//         && is_array($config[$config['transport_type']])
//         && count($config[$config['transport_type']])
//     ) {
//         foreach ($config[$config['transport_type']] as $optionKey => $optionValue) {
//             $methodName = 'set' . str_replace('_', '', ucwords($optionKey, '_'));
//             $transport->{$methodName}($optionValue);
//         }
//     }
//     return new \Swift_Mailer($transport);
// };





//


$container['generalErrorHandler'] = function ($container) {
    return new \Core\Handlers\GeneralErrorHandler($container);
};

// $container['errorHandler'] = function ($container) {
//     return function ($request, $response, $exception) use ($container) {
//         return $container['response']->withStatus(500)
//                              ->withHeader('Content-Type', 'text/html')
//                              ->write('Something went wrong!');
//     };
// };

// Service factory for the ORM
$container['validator'] = function () {
    return new App\Validation\Validator();
};


$container['eloquent'] = function ($container) {
    $db = $container['settings']['databases']['db'];

    $capsule = new \Illuminate\Database\Capsule\Manager;
    $capsule->addConnection($db);
    $capsule->setAsGlobal();
    $capsule->bootEloquent();
    $capsule::connection()->enableQueryLog();

    return $capsule;
};

// database
$capsule = new Capsule;
$capsule->addConnection($config['settings']['databases']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

// monolog
$container['logger'] = function ($container) {
    $settings = $container->get('settings')['app']['logger'];
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
$container['session'] = function ($container)  {
    $setting_session_driver = $container['settings']['session']['driver'] ?? 'session';
    $sessionOBJ = new \Core\Services\Session();
    $session = $sessionOBJ->init($setting_session_driver) ;
    return $session;
};

//$setting_session_driver = $container[' ings']['session']['driver'] ?? 'session';
//
//$sessionOBJ = new \Core\Services\Session($setting_session_driver);
//$session = $sessionOBJ->init('session') ;


// Register Blade View helper
$container['view'] = function ($container) {
    $messages = $container->flash->getMessages();

    if(!is_dir('../app/View/cache')){
        @mkdir('../app/View/cache');
    }


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

// Register Blade View helper
$container['json'] = function ($container) {
    return new \Core\Handlers\JsonHandler();
};

$container['jsonApi'] = function ($container) {
    return new \Core\Renderers\JsonApiRenderer();
};



$app->getContainer()['view']->getRenderer()->getCompiler()->directive('helloWorld', function(){

    return "<?php echo 'Hello Directive'; ?>";
});



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


// data access container
$array = getDirFiles(__APP_ROOT__.'/app/DataAccess/');
foreach($array as $key=>$item){
    $classDataAccessFolder[$item] = getDirFiles(__APP_ROOT__.'/app/DataAccess/'.$item);

}
$result = array();
foreach($classDataAccessFolder as $DaFolder=>$DAFile)
{
    foreach($DAFile as $r){
        $dataAccessFiles[$r] = $DaFolder.'\\'.$r;
    }
}

foreach($dataAccessFiles as $key=>$dataAccessFile){
    $contentDataAccess = preg_replace('/.php/','',$dataAccessFile);
    $containerDataAccess = preg_replace('/.php/','',$key);
    $container[$containerDataAccess] = function ($container) use ($contentDataAccess){
        $classDataAccess =  '\\App\\DataAccess\\'.$contentDataAccess ;
        return new $classDataAccess($container);
    };
}





$GLOBALS['container'] = $container;
$GLOBALS['app'] = $app;
$GLOBALS['settings'] = $container['settings'];



return $container;

