<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 11/12/17
 * Time: 11:52 PM
 */

namespace App\Controller;



use Respect\Validation\Validator as v;
use Slim\Http\Request;
use Slim\Http\Response;

class AuthController extends Controller
{

    function register(Request $request , Response $response)
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