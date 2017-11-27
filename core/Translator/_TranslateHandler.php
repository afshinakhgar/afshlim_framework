<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 11/20/17
 * Time: 10:46 AM
 */

namespace Core\Translator;


use Psr\Container\ContainerInterface;

abstract class _TranslateHandler
{
    protected $container ;
    protected $local;

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


    /**
     * Get Slim Container
     *
     * @return ContainerInterface
     */
    protected function getContainer()
    {
        return $this->container;
    }

    abstract public function trans(string $key , array $replace);
}