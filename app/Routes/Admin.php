<?php
$app->group('/admin/user', function () use ($app , $route) {
    $app->get('/list', \App\Controller\Admin\User\UserController::class.':index_Action')->setName('admin.user.list');
})->add(App\Middleware\AuthenticationMiddleware::class);

$app->group('/admin/role', function () use ($app , $route) {
    $app->get('/list', \App\Controller\Admin\User\RoleController::class.':index_Action')->setName('admin.user.role.list');
    $app->get('/users/[{role_id}]', \App\Controller\Admin\User\RoleController::class.':usersByRole_Action')->setName('admin.role.user_list');

    $app->get('/create', \App\Controller\Admin\User\RoleController::class.':get_create')->setName('admin.user.role.create');

    $app->post('/create', \App\Controller\Admin\User\RoleController::class.':post_create')->setName('admin.user.role.create');
})->add(App\Middleware\AuthenticationMiddleware::class);

