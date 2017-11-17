<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 11/12/17
 * Time: 11:52 PM
 */

namespace App\Controller\User;



use App\Controller\Controller;
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
            $validation = $this->validator->validate($request,[
                'email' => v::noWhitespace()->notEmpty()->email()->emailAvailable(),
                'name' => v::noWhitespace()->notEmpty()->alpha(),
                'password' => v::noWhitespace()->notEmpty(),
            ]);


            if ($validation->failed()) {
                return $response->withRedirect($this->router->pathFor('auth.signup'));
            }else{
                $user = User::create([
                    'first_name' => 'afshin',
                    'last_name' => 'akhgar',
                    'email' => 'afshi2n@2a.com',
                    'password' => crypt('afshin@a.com'),
                ]);
            }
    }
}