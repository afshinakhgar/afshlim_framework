<?php
use App\Controller\HomeController;
$route = new \Core\Route($app);

$files = getDirFiles(__APP_ROOT__.'app/Routes/');
/** Route Partial Loadup =================================================== */
foreach ($files as $partial) {
    $file = __APP_ROOT__.'app/Routes/'.$partial;
    $filse[] = $file;
    if ( ! file_exists($file))
    {
        $msg = "Route partial [{$partial}] not found.";
    }
    include $file;
}

$route->get('/', HomeController::class.':index')->setName('home');

$route->resource('/user/auth', '\App\Controller\User\AuthController', $args = []);


