<?php
namespace App\Middleware;

use Core\Facades\Auth;

use Core\Interfaces\_Middleware;

class RoleMiddleWare extends _Middleware
{



    private $role;

    public function __construct($role)
    {
        $this->role = $role;
    }

    /**
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @param \Psr\Http\Message\ResponseInterface      $response
     * @param callable                                 $next
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke($request, $response, $next  )
    {

        $role = Auth::hasRole($this->role);

        if(!$role){
            return $response->withRedirect('/');
        }

        $response = $next($request, $response);


        return $response;
    }
}
