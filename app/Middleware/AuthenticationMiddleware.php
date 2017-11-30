<?php
namespace App\Middleware;

use Core\Facades\Auth;

use Core\Interfaces\_Middleware;

class AuthenticationMiddleware extends _Middleware
{

    /**
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @param \Psr\Http\Message\ResponseInterface      $response
     * @param callable                                 $next
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke($request, $response, $next )
    {
        if(!Auth::check()){
            return $response->withRedirect('/');
        }

        $response = $next($request, $response);


        return $response;
    }
}
