<?php
namespace App\Controller;


use App\Model\Test;
use Slim\Http\Request;
use Slim\Http\Response;

class HomeController extends Controller
{

    private $testModel;

    function __construct($container)
    {
        parent::__construct($container);



        $this->testModel = new Test();

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

//
//        // Or create a new book
//        $book = new Test(array(
//            'name' => 'afshin22',
//            'email' => 'afshi2n@2a.com',
//            'password' => crypt('afshin@a.com'),
//        ));
//        $book->save();
//        echo $book->toJson();


        dd($this->getContainer('translator')->trans('title'));
        return $this->view->render($response, 'index');



        //Render a Template
//        $response = $this->view->render($response, "index.php");
    }



}