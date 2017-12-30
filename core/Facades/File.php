<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 11/24/17
 * Time: 1:08 PM
 */

namespace Core\Facades;

use Core\Services\File as FileService;
use SlimFacades\Facade;
class File extends Facade
{
    /**
     * @param Core\Services\AuthService\AuthService
     * @return AuthService
     */
    protected static function getFacadeAccessor()
    {
        return 'FileService';
    }
}
