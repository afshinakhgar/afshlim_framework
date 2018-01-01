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
     * @param string $loginField
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


    public static function getUserOneByMobile(string $mobile)
    {
        return User::where('mobile',$mobile)->first();
    }


    public static function getUserOneByUsername(string $username)
    {
        return User::where('username',$username)->first();
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


    public static function checkToken($token , $mobile)
    {
        $token = Token::where('code',$token)->first();
        if($token){
            $user = self::getUserById($token->user_id);
        }else{
            return false;
        }

        if($token->used == 0 && $mobile == $user->mobile){
            $token->used = 1;
            $token->save();
        }else{
            return false;
        }

        return true;
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



    /**
     * @return array User
     */
    public static function getAllUsers(int $limit = 20)
    {
        return User::paginate($limit);
    }



    public static function getUserRoles(int $userid)
    {
        return User::find((int)$userid)->roles()->get();
    }




    public static function updateuserFieldById($user,array $fields)
    {
        foreach($fields as $field=>$value){
            $user->$field = $value;
        }
        $user->save();


        return $user;
    }


    public static function createUsersByFields(array $fields)
    {

        $user = new User;
        foreach($fields as $field=>$value){
            $user->$field = $value;
        }

        $user->save();

        return $user;
    }



}