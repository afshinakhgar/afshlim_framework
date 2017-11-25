<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 11/25/17
 * Time: 11:00 AM
 */

namespace Core;



class Route
{

    protected $app;

    function __construct($app)
    {
        $this->app = $app;
    }

    /**
     * Get Slim Container
     *
     * @return ContainerInterface
     */
    protected function getContainer()
    {
        return $this->app->container;
    }



    public  function resource($url, $controller, $args = [])
    {
        $url = rtrim($url,'/');
        $this->app->group($url, function () use ($controller, $args) {
            $this->get('', $controller . ':index')->add(self::middleware('index', $args));
            $this->get('/create', $controller . ':create')->add(self::middleware('create', $args));
            $this->get('/{id:[0-9]+}', $controller . ':show')->add(self::middleware('show', $args));
            $this->get('/{id:[0-9]+}/edit', $controller . ':edit')->add(self::middleware('edit', $args));
            $this->post('', $controller . ':store')->add(self::middleware('store', $args));
            $this->put('/{id:[0-9]+}', $controller . ':update')->add(self::middleware('update', $args));
            $this->patch('/{id:[0-9]+}', $controller . ':update')->add(self::middleware('index', $args));
            $this->delete('/{id:[0-9]+}', $controller . ':destroy')->add(self::middleware('destroy', $args));

        })->add(self::middleware('group', $args));
    }

    /**
     * @param string $middlewareType
     * @param $args
     * @return \Closure
     */
    public static function middleware($middleWare = "group", $args)
    {
        $routeResourceMiddleWare_default = function ($request, $response, $next) {
            return $next($request, $response);
        };

        return $middleware = $args['middleware'][$middleWare] ?? $routeResourceMiddleWare_default;
    }



    /********************************************************************************
     * Router proxy methods
     *******************************************************************************/

    /**
     * Add GET route
     *
     * @param  string $pattern  The route URI pattern
     * @param  callable|string  $callable The route callback routine
     *
     * @return \Slim\Interfaces\RouteInterface
     */
    public function get($pattern, $callable)
    {
        return $this->app->map(['GET'], $pattern, $callable);
    }

    /**
     * Add POST route
     *
     * @param  string $pattern  The route URI pattern
     * @param  callable|string  $callable The route callback routine
     *
     * @return \Slim\Interfaces\RouteInterface
     */
    public function post($pattern, $callable)
    {
        return $this->app->map(['POST'], $pattern, $callable);
    }

    /**
     * Add PUT route
     *
     * @param  string $pattern  The route URI pattern
     * @param  callable|string  $callable The route callback routine
     *
     * @return \Slim\Interfaces\RouteInterface
     */
    public function put($pattern, $callable)
    {
        return $this->app->map(['PUT'], $pattern, $callable);
    }

    /**
     * Add PATCH route
     *
     * @param  string $pattern  The route URI pattern
     * @param  callable|string  $callable The route callback routine
     *
     * @return \Slim\Interfaces\RouteInterface
     */
    public function patch($pattern, $callable)
    {
        return $this->app->map(['PATCH'], $pattern, $callable);
    }

    /**
     * Add DELETE route
     *
     * @param  string $pattern  The route URI pattern
     * @param  callable|string  $callable The route callback routine
     *
     * @return \Slim\Interfaces\RouteInterface
     */
    public function delete($pattern, $callable)
    {
        return $this->app->map(['DELETE'], $pattern, $callable);
    }

    /**
     * Add OPTIONS route
     *
     * @param  string $pattern  The route URI pattern
     * @param  callable|string  $callable The route callback routine
     *
     * @return \Slim\Interfaces\RouteInterface
     */
    public function options($pattern, $callable)
    {
        return $this->app->map(['OPTIONS'], $pattern, $callable);
    }

    /**
     * Add route for any HTTP method
     *
     * @param  string $pattern  The route URI pattern
     * @param  callable|string  $callable The route callback routine
     *
     * @return \Slim\Interfaces\RouteInterface
     */
    public function any($pattern, $callable)
    {
        return $this->app->map(['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'OPTIONS'], $pattern, $callable);
    }


}