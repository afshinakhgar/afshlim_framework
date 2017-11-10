<?php
namespace App\Controller;


use Slim\Http\Request;
use Slim\Http\Response;

class HomeController extends Controller
{

    function index(Request $request , Response $response)
    {



        //Render a Template
        $response = $this->view->render($response, "index.php");
    }



}