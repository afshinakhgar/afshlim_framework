<?php

namespace App\Controller\Admin\User;
use App\Controller\Controller;
use App\DataAccess\User\RoleDataAccess;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class RoleController extends Controller
{

    public function index_Action(Request $request, Response $response, $args)
    {

        $list = RoleDataAccess::getAllRoles();

        return $this->view->render($response, 'admin.user.role.index',[
            'list'=>$list
        ]);

    }
    public function usersByRole_Action(Request $request, Response $response, $args)
    {

        $list = RoleDataAccess::getUsersRole();

        return $this->view->render($response, 'admin.user.role.index',[
            'list'=>$list
        ]);

    }
}