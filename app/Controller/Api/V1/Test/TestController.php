<?php

namespace App\Controller\Api\V1\Test;
use App\Controller\Controller;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class TestController extends Controller
{

    public function index(Request $request, Response $response, $args)
    {
        return $this->jsonApi->render($response,['username' => 'akhgar.net', 'realname' => 'Afsh', 'age' => 32]);
    }
}