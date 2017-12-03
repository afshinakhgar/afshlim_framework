<?php
$app->group('/admin/user', function () use ($app , $route) {
    $app->get('/list', \App\Controller\Admin\User\UserController::class.':index_Action')->setName('admin.user.list');
})->add(App\Middleware\AuthenticationMiddleware::class);

$app->group('/admin/role', function () use ($app , $route) {
    $app->get('/list', \App\Controller\Admin\User\RoleController::class.':index_Action')->setName('admin.role.list');
    $app->get('/users', \App\Controller\Admin\User\RoleController::class.':usersByRole_Action')->setName('admin.role.user_list');
})->add(App\Middleware\AuthenticationMiddleware::class);

