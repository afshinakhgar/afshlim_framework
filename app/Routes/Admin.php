<?php
$app->group('/admin/user', function () use ($app , $route) {
    $app->get('/list', \App\Controller\Admin\User\UserController::class.':index_Action')->setName('admin.user.list');
    $app->get('/rolelist', \App\Controller\Admin\User\RoleController::class.':role_list_Action')->setName('admin.user.role.list');
})->add(App\Middleware\AuthenticationMiddleware::class);

