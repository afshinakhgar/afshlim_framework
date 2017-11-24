<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 11/24/17
 * Time: 1:08 PM
 */

namespace Core\Facades;

use SlimFacades\Facade;
class Auth extends Facade
{
    protected static function getFacadeAccessor()
    {
        //Change 'serviceName' to you want.
        return 'AuthService';
    }
}
