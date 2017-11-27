<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 11/24/17
 * Time: 12:20 AM
 */

namespace App\DataAccess\User;


use App\Model\Token;
use Core\Helpers\Hash;
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
    public static function getUserLoginField(string $loginField)
    {
        return User::where('username', $loginField)
            ->orWhere('email', $loginField)
            ->orWhere('mobile', $loginField)
            ->first();
    }

    public static function getUserById(int $userid)
    {
        return User::find((int)$userid);
    }


    public static function createNewToken(int $userid)
    {
        $notUsedToken = self::getTokenByUsedUserid($userid);
        if($notUsedToken){
            return $notUsedToken;
        }

        $token = new Token();
        $rand = rand(10000, 99999);
        $token->code = $rand;
        $token->user_id = (int)$userid;
        $token->used = 0;
        $token->save();

        return $token;
    }


    static function getTokenByUsedUserid(int $userid)
    {
        $token = Token::where('user_id',$userid)->where('used',0)->first();
        if($token){
            return $token;
        }else{
            return false;
        }
    }


}