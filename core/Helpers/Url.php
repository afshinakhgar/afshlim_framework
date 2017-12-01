<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 11/13/17
 * Time: 3:19 PM
 */

namespace Core\Helpers;


use Core\Route;
use Slim\Http\Request;

class Url
{
    protected $container;
    public function __construct($container)
    {
        $this->container = $container;
    }
    public function get( $name, $params = array() )
    {
            $route = $this->container->get('router')->pathFor($name,$params);


            return $route;
//        $name = $route->getName();
//        $groups = $route->getGroups();
//        $methods = $route->getMethods();
//        $arguments = $route->getArguments();

    }
}