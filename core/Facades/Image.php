<?php
namespace Core\Facades;

use Core\Services\ImageService  ;
use SlimFacades\Facade;
class Image extends Facade
{
    /**
     * @param Core\Services\AuthService\AuthService
     * @return AuthService
    */
    protected static function getFacadeAccessor()
    {
        return 'ImageService';
    }
}
