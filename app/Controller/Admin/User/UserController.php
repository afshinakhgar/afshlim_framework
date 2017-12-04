<?php

namespace App\Controller\Admin\User;
use App\Controller\Controller;
use App\DataAccess\User\RoleDataAccess;
use App\DataAccess\User\UserDataAccess;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class UserController extends Controller
{

    public function index_Action(Request $request, Response $response, $args)
    {
        $list = UserDataAccess::getAllUsers();
        return $this->view->render($response, 'admin.user.index',[
            'list'=>$list
        ]);
    }


    public function get_userrole(Request $request, Response $response, $args)
    {
        $userid = (int)$args['userid'];

        $user = UserDataAccess::getUserById($userid);

        $all_roles = RoleDataAccess::listAllRoles();

        foreach($user->roles as $role){
            $roleList[$role->id] = $role->display_title;
        }


        return $this->view->render($response, 'admin.user.userrole',[
            'user'=>$user,
            'roles'=>$roleList,
            'all_roles'=>$all_roles,
        ]);
    }


    public function post_userrole(Request $request, Response $response, $args)
    {
        $list = UserDataAccess::getAllUsers();
        return $this->view->render($response, 'admin.user.index',[
            'list'=>$list
        ]);
    }
}