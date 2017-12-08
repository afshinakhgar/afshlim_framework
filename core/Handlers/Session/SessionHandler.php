<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 12/8/17
 * Time: 1:04 AM
 */

namespace Core\Handlers\Session;


use Core\Interfaces\_Session;

class SessionHandler implements _Session
{
    public function get($key = null)
    {
        if(!isset($_SESSION)) return [];

        if(!$key){
            return $_SESSION;
        }else{
            $keys = explode('.',$key);
            $sessionVal = $this->getRecursiveSessionKey($_SESSION,$keys);
            return $sessionVal;
        }
    }

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



    public function set($key,$val)
    {
//        $keys = explode('.',$key);
//        foreach ($keys as $key) {
//            if (!array_key_exists($key, $_SESSION)) {
//                $reference[$key] = [];
//            }
//            $reference[$key] = 1;
//        }
////        $reference = $val;
//
//
//
//        dd($reference);
//        $_SESSION = $val;
    }
}