<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 11/21/17
 * Time: 7:10 PM
 */

namespace Core\Facade;


class Input extends Facade
{
    protected static function getFacadeAccessor() { return 'request'; }
    public static function file($name)
    {
        return isset($_FILES[$name]) && $_FILES[$name]['size'] ? $_FILES[$name] : null;
    }
}