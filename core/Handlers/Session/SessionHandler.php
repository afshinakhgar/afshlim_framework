<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 12/8/17
 * Time: 1:04 AM
 */

namespace Core\Handlers\Session;


use Core\Interfaces\_Session;

class SessionHandler extends SessionInterface implements _Session
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

    public function set($key,$val)
    {
        $_SESSION = $this->setArr($key,$val);
    }


    public function exists($key,$val)
    {
       $keySession = $this->get($key);

       if($keySession){
          return true;
       }
       return false;
    }


}