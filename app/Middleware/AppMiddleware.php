<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 11/13/17
 * Time: 1:31 PM
 */

namespace App\Middleware;


use Core\Interfaces\_Middleware;

class AppMiddleware extends _Middleware
{
    public function __invoke($request, $response, $next )
    {
//        $response->getBody()->write('BEFORE');
//      Before App
//        $routeParams = $request->getAttribute('routeInfo')[2];

//        $parameters = explode('/',$routeParams['params']);
        $response = $next($request, $response);
//        $response->getBody()->write('AFTER');
//
        return $response;
    }
}

