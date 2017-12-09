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
        $user_roleList = [];
        $user = UserDataAccess::getUserById($userid);
        $user_roleList = UserDataAccess::getUserRoles($userid);

        $all_roles = RoleDataAccess::listAllRoles();
        foreach($all_roles as $role){
            $allRolesList[$role->id] = $role->display_name;
        }

        return $this->view->render($response, 'admin.user.userrole_form',[
            'user'=>$user,
            'user_roleList'=>$user_roleList,
            'all_roles'=>$allRolesList,
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