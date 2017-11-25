<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 11/24/17
 * Time: 12:20 AM
 */

namespace App\DataAccess\User;


use Core\Interfaces\_DataAccess;
use PDO;
use App\Model\User;

/**
 * @param UserDataAccess
 */

class UserDataAccess extends _DataAccess
{
    /**
     * @param string $username
     * @param string $email
     * @param string $mobile
     * @return User
     */
    public static function  getUserLoginField(string $loginField)
    {
        return User::where('username',$loginField)
            ->orWhere('email',$loginField)
            ->orWhere('mobile',$loginField)
            ->first();
    }

    public static function getUserById(int $userid)
    {
        return User::find((int)$userid);
    }


}