<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 11/16/17
 * Time: 12:02 PM
 */

namespace Core;

class Config {

    public static function get($key,$default = null){
        $path = __APP_ROOT__ . '/config/'.$key[0].'.php';
        $result = include_once $path;
        foreach (explode('.' , $key) as $segment) {
            if(isset($result[$segment]))
                $result = $result[$segment];
            else
                $result = $default;
        }
        return $result;
    }
}