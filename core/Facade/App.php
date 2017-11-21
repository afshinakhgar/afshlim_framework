<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 11/21/17
 * Time: 7:10 PM
 */

namespace Core\Facade;

class App extends Facade
{
    protected static function getFacadeAccessor() { return self::$slim; }
    public static function make($key)
    {
        return self::$app[$key];
    }
}