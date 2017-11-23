<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 11/23/17
 * Time: 10:59 PM
 */

namespace Core;

use Respect\Validation\Validator as v;
use Slim\Http\Request;

class Validator extends v
{
    protected $container;

    function __construct($container)
    {
        $this->container = $container;
    }

    public function __get($property)
    {
        if ($this->container->{$property}) {
            return $this->container->{$property};
        }
    }




    /**
     * Get Slim Container
     *
     * @return ContainerInterface
     */
    protected function getContainer()
    {
        return $this->container;
    }
    /**
     * Get Service From Container
     *
     * @param string $service
     * @return mixed
     */
    protected function getService($service)
    {
        return $this->container->{$service};
    }

}