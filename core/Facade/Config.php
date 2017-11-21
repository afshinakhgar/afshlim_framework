<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 11/21/17
 * Time: 7:10 PM
 */

namespace Core\Facade;


class Config extends Facade
{
    protected static function getFacadeAccessor() { return self::$slim; }
    public static function get($key)
    {
        return self::$slim->config($key);
    }
    public static function set($key, $value)
    {
        return self::$slim->config($key, $value);
    }
}