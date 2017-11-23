<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 11/12/17
 * Time: 11:52 PM
 */

namespace App\Controller\User;


use App\DataAccess\User\UserDataAccess;
use App\Model\User;


use App\Controller\Controller;
use Core\Helpers\Hash;
use Core\Validator as v;
use Slim\Http\Request;
use Slim\Http\Response;

class AuthController extends Controller
{

    public function get_register_Action(Request $request , Response $response )
    {
        return $this->view->render($response, 'auth/register');
    }


    public function post_register_Action(Request $request , Response $response)
    {
        $validate = $this->validator->validate($request,[
            'firstname' => v::noWhitespace()->notEmpty()->alpha(),
            'lastname' => v::noWhitespace()->notEmpty()->alpha(),
            'mobile' => v::noWhitespace()->notEmpty(),
            'email' => v::noWhitespace()->notEmpty(),
            'username' => v::noWhitespace()->notEmpty(),
        ]);


        try{
            if($validate){

                $params = $request->getParams();
                $userOne = UserDataAccess::getUserByEmail_OR_Mobile_OR_Username_one_r($params['username'],$params['email'],$params['mobile']);

                if(!isset($userOne->id)){
                    $user = new User();
                    $hash = new Hash();
                    $user->first_name = $request->getParam('firstname');
                    $user->last_name = $request->getParam('lastname');
                    $user->email = $request->getParam('email');
                    $user->username = $request->getParam('username');
                    $user->mobile = $request->getParam('mobile');
                    $user->password = $hash->hash($request->getParam('password'));
                    $user->api_token = $hash->hash($request->getParam('email'));
                    $user->save();
                    return $response->withRedirect('/');
                }else{
                    return $response->withRedirect('/');
                }

            }else{

            }

        } catch (Exception $e) {
            // Generate Exception Error
        }



    }
}