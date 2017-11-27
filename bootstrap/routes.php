<?php
use App\Controller\HomeController;

//
//$resourceFullRoutes = [
//    'get' => [
//        'index',
//        'one/{id:[0-9]}',
//        'edit/{id:[0-9]}',
//    ],
//    'delete'=> [
//        'delete'
//    ],
//    'post' => [
//        'store',
//    ],
//    'put' => [
//        'update'
//    ]
//
//];
//

$route = new \Core\Route($app);





$files = getDirFiles(__APP_ROOT__.'app/Routes/');
/** Route Partial Loadup =================================================== */
foreach ($files as $partial) {
    $file = __APP_ROOT__.'app/Routes/'.$partial;

    if ( ! file_exists($file))
    {
        $msg = "Route partial [{$partial}] not found.";
    }

    require_once $file;
}

$route->resource('/user/auth', '\App\Controller\User\AuthController', $args = []);
