<?php
namespace App\Controller;


use App\Model\User;
use Slim\Http\Request;
use Slim\Http\Response;

class UserController extends Controller
{

    private $testModel;

    function __construct($container)
    {
        parent::__construct($container);

    }





    function index(Request $request , Response $response)
    {

//        $this->flash->addMessage('Test', 'This is a message');
//
//        // Redirect
//        return $response->withStatus(200)->withHeader('Location', '/public');
//
//
//


        //Render a Template
        $response = $this->view->render($response, "index.php");
    }



}