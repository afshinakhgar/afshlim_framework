<?php
namespace App\Controller;


use Slim\Http\Request;
use Slim\Http\Response;

class HomeController extends Controller
{

    function index(Request $request , Response $response)
    {

//        $this->flash->addMessage('Test', 'This is a message');
//
//        // Redirect
//        return $response->withStatus(200)->withHeader('Location', '/public');
//
//
//

        $a = [
          'a'=>213123
        ];
        //Render a Template
        $response = $this->view->render($response, "index.php",$a);
    }



}