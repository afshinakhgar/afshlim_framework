<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 11/24/17
 * Time: 1:11 PM
 */

namespace Core\Services;

use App\DataAccess\User\UserDataAccess;
use Core\App;
use Core\Config;
use Core\Interfaces\_Service;

class AuthService extends _Service
{
    public function user()
    {
        if(!isset($_SESSION['user']) && json_decode($_COOKIE['user'],true) !== null){
            $_SESSION['user'] = json_decode($_COOKIE['user'],true);
        }
        return UserDataAccess::getUserById(isset($_SESSION['user']['user_id']) ? $_SESSION['user']['user_id'] : 0);
    }

    public function hasRole($roleName)
    {
        if(!self::check()){
            return false;
        }
        $userRoles =  UserDataAccess::getUserRoles(isset($_SESSION['user']['user_id']) ? $_SESSION['user']['user_id'] : 0);
        $hasAccess = false;
        foreach ($userRoles as $role){
            if($role->name == $roleName){
                $hasAccess = true;
                break;
            }
        }
        return $hasAccess;
    }


    public function check()
    {
        if(!isset($_SESSION['user']) && json_decode($_COOKIE['user'],true) !== null){
            $_SESSION['user'] = json_decode($_COOKIE['user'],true);
        }
        return isset($_SESSION['user']['user_id']);
    }

    public function attempt(string $loginField,string $password)
    {
        $user = UserDataAccess::getUserLoginField($loginField);
        if (!$user) {
            return [
                'type'=>'error',
                'message'=> 'User Not Exists',
            ];
        }
        $setting = Config::get('settings.auth');
        if(1 || $setting['2step']){
            return $this->twoStepAuth($loginField,$password);
        }else{
            if ($this->checkPass($password,$user->password)) {
                $_SESSION['user']['user_id'] = $user->id;
                $_SESSION['user']['mobile'] = $user->mobile;

                setcookie('user', json_encode([
                    'user_id'=>$user->id,
                    'mobile'=>$user->mobile,
                ]), time() + (86400 * 30), "/"); // 86400 = 1 day *30 => 30 day


                return [
                    'type'=>'success',
                    'message'=> 'Logined',
                ];
            }else{
                return [
                    'type'=>'error',
                    'message'=> 'password mismatch',
                ];
            }
        }
        return [
            'type'=>'error',
            'message'=> 'problem!',
        ];
    }



    public function checkPass($password,$database_pass)
    {
        if($database_pass == $password){
            return true;
        }
        return false;

    }


    public function twoStepAuth(string $loginField,string $password)
    {
        $user = UserDataAccess::getUserLoginField($loginField);
        if(UserDataAccess::checkToken($password,$loginField)){
            $_SESSION['user']['user_id'] = $user->id;
            $_SESSION['user']['mobile'] = $user->mobile;

            setcookie('user', json_encode([
                'user_id'=>$user->id,
                'mobile'=>$user->mobile,
            ]), time() + (86400 * 30), "/"); // 86400 = 1 day *30 => 30 day


            return [
                'type'=>'success',
                'message'=> 'Logined',
            ];
        }else{
            return [
                'type'=>'error',
                'message'=> 'problem!',
            ];
        }
    }

    public function logout()
    {
        if (isset($_COOKIE['user'])) {
            unset($_COOKIE['user']);
            setcookie('user', '', time() - 3600, '/'); // empty value and old timestamp
        }
        unset($_SESSION['user']);
    }

}