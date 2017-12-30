<?php
$roleMiddleWare = new App\Middleware\RoleMiddleWare( 'admin' );


$app->group('/admin/user', function () use ($app , $route) {
    $app->get('/list', \App\Controller\Admin\User\UserController::class.':index_Action')->setName('admin.user.list');

    $app->get('/info/{mobile}', \App\Controller\Admin\User\UserController::class.':get_info_Action')->setName('admin.user.info');

    $app->get('/new', \App\Controller\Admin\User\UserController::class.':get_new_Action')->setName('admin.user.new');

    $app->post('/new', \App\Controller\Admin\User\UserController::class.':post_store_Action')->setName('admin.user.store');

    $app->get('/edit/{mobile}', \App\Controller\Admin\User\UserController::class.':get_edit_Action')->setName('admin.user.edit');

	$app->post('/update/', \App\Controller\Admin\User\UserController::class.':put_update_Action')->setName('admin.user.update');

    $app->get('/editroles/[{userid}]', \App\Controller\Admin\User\UserController::class.':get_userrole')->setName('admin.user.editroles');
    $app->post('/editroles', \App\Controller\Admin\User\UserController::class.':post_userrole')->setName('admin.user.userrole');
})->add($roleMiddleWare);

$app->group('/admin/role', function () use ($app , $route) {
    $app->get('/list', \App\Controller\Admin\User\RoleController::class.':index_Action')->setName('admin.user.role.list');
    $app->get('/users/[{role_id}]', \App\Controller\Admin\User\RoleController::class.':usersByRole_Action')->setName('admin.role.user_list');
    $app->get('/create', \App\Controller\Admin\User\RoleController::class.':get_create')->setName('admin.user.role.create');
    $app->post('/create', \App\Controller\Admin\User\RoleController::class.':post_create')->setName('admin.user.role.create');
})->add($roleMiddleWare);

