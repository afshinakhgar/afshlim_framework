<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 11/24/17
 * Time: 1:08 PM
 */

namespace Core\Facades;

use Core\Services\AuthService;
use SlimFacades\Facade;
class Auth extends Facade
{
    /**
     * @param Core\Services\AuthService\AuthService
     * @return AuthService
    */
    protected static function getFacadeAccessor()
    {
        return 'AuthService';
    }
}
