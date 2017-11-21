<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 11/21/17
 * Time: 7:10 PM
 */

namespace Core\Facade;


class Response extends Facade
{
    protected static function getFacadeAccessor() { return 'response'; }

}