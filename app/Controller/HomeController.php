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

        $this->testModel->serialnumber = 123;
        $this->testModel->name = 'My Test Widget';
        $this->testModel->save();
        echo 'Created!';


        $a = [
          'a'=>213123
        ];
        //Render a Template
        $response = $this->view->render($response, "index.php",$a);
    }



}