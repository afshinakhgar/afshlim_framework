<?php

namespace App\Controller\Admin\User;
use App\Controller\Controller;
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
}