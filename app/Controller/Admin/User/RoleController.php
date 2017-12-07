<?php

namespace App\Controller\Admin\User;
use App\Controller\Controller;
use App\DataAccess\User\RoleDataAccess;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Views\Blade;
use Respect\Validation\Validator as v;

class RoleController extends Controller
{

    public function index_Action(Request $request, Response $response, $args)
    {


        $list = RoleDataAccess::getAllRoles();

        return $this->view->render($response, 'admin.user.role.index',[
            'list'=>$list
        ]);

    }
    /**
     * @method post
     * @param $request
     * @param $response
     * @param $args
     * @return Blade
    */
    public function post_create(Request $request, Response $response, $args)
    {
        $validate = $this->validator->validate($request,[
            'name' => v::notEmpty()->alpha(),
            'display_name' => V::notEmpty()->alpha(),
        ]);

        try{

            if(!$validate->failed()){

                $params = $request->getParams();


                $createRole = RoleDataAccess::createRole($params);

                if(!isset($createRole->id)){
                    $this->flash->addMessage('info','Role Has been created');
                    return $response->withRedirect('list');
                }else{
                    $this->flash->addMessage('error','Role already exists');

                    return $response->withRedirect('list');
                }

            }else{
                $this->flash->addMessage('error','Invalid Inputs');
                return $response->withRedirect('list');
            }

        } catch (Exception $e) {
            // Generate Exception Error
        }

    }

    /**
     * @method get
     * @param $request
     * @param $response
     * @param $args
     * @return Blade
     */
    public function get_create(Request $request, Response $response, $args)
    {
        return $this->view->render($response, 'admin.user.role.form');

    }



    public function usersByRole_Action(Request $request, Response $response, $args)
    {

        $list = RoleDataAccess::getRoleById((int)$args['role_id']);
        return $this->view->render($response, 'admin.user.role.users_list',[
            'list' => $list
        ]);

    }
}