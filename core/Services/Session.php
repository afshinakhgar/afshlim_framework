<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 12/8/17
 * Time: 1:01 AM
 */

namespace Core\Services;



class Session
{
    public $handler;
    public function init($driver)
    {
        $namespace = 'Core\\Handlers\\Session\\';

        $className = $namespace.ucfirst($driver).'Handler';
        $this->handler = new $className();

        return $this->handler;
    }

}