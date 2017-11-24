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
class UserDataAccess extends _DataAccess
{
    /**
     * @param string $username
     * @param string $email
     * @param string $mobile
     * @return User
     */
    function getUserByEmail_OR_Mobile_OR_Username_one_r(string $username,string $email,string $mobile)
    {
        return User::where('username',$username)
            ->orWhere('email',$email)
            ->orWhere('mobile',$mobile)
            ->first();
    }

    function getUserById(int $userid)
    {
        return User::find((int)$userid);
    }


}