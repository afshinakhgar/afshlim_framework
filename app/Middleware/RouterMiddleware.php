<?php
namespace App\Middleware;

use Core\Interfaces\_Middleware;
use Illuminate\Database\Capsule\Manager as DB;

class RouterMiddleware extends _Middleware {

    public function __invoke($request, $response, $next) {

        $uri          = $request->getUri();
        $current_path = $uri->getPath();
        $route        = $request->getAttribute('route');

        if ($route) {

            $route_name = $route->getName();
            $uri_page_parameter = $request->getParam('page');
            // We want to retrieve the whole url including all the get parameters to get the current url itself
            // Excluding page (pagination) parameter.
            if ($uri_page_parameter != '') {
                $uri = str_replace(['?page=' . $uri_page_parameter, '&page=' . $uri_page_parameter], '', $uri);
            }

            // We'll also check if the request has been sent using get method
            $uri_request_sent = explode('?', $uri);


            $GLOBALS['current_route_path'] = rtrim($current_path,'/');
        }

        $response = $next($request, $response);
        return $response;
    }
}

