<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 12/8/17
 * Time: 11:28 PM
 */

namespace Core\Interfaces;


class AbstractSession
{

     public function getRecursiveSessionKey($data , $keyArr){
        $arrayFound  = isset($data[$keyArr[0]]) ? $data[$keyArr[0]] : '';
        if($arrayFound){
            unset($keyArr[0]);
            $keyArr = array_values($keyArr);
            if(isset($keyArr[0])){
                return $this->getRecursiveSessionKey($arrayFound,$keyArr);
            }
        }
        return $arrayFound ;
    }


    public static function setArr($key, $value)
    {
        foreach (explode('.', $key) as $keyName) {
            if (false === isset($source)) {
                $source    = array();
                $sourceRef = &$source;
            }
            $keyName = trim($keyName);
            $sourceRef  = &$sourceRef[$keyName];
        }
        $sourceRef = $value;
        unset($sourceRef);
        return $source;
    }

}