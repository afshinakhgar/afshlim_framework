<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 11/24/17
 * Time: 12:21 AM
 */

namespace Core\Interfaces;


use Psr\Container\ContainerInterface;
use SlimFacades\Facade;

abstract class _DataAccess
{
    protected $container;

    function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function __get($property)
    {
        if ($this->container->{$property}) {
            return $this->container->{$property};
        }
    }
}