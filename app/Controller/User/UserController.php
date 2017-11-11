<?php
namespace App\Controller;


use App\Model\User;
use Slim\Http\Request;
use Slim\Http\Response;

class HomeController extends Controller
{

    private $testModel;

    function __construct($container)
    {
        parent::__construct($container);

    }



    function register()
    {
        $user = User::create([
            'first_name' => 'afshin',
            'last_name' => 'akhgar',
            'email' => 'afshi2n@2a.com',
            'password' => crypt('afshin@a.com'),
        ]);




        $response = $this->view->render($user, "index.php");



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