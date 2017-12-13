<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 11/24/17
 * Time: 1:11 PM
 */

namespace Core\Services;

use App\DataAccess\User\UserDataAccess;
use Core\Config;
use Core\Interfaces\_Service;

class AuthService extends _Service
{
    public function user()
    {
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
        if($setting['2step']){
            $this->twoStepAuth();
        }else{
            if ($this->checkPass($password,$user->password)) {
                $_SESSION['user']['user_id'] = $user->id;
                $_SESSION['user']['mobile'] = $user->mobile;
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


    public function twoStepAuth()
    {
        return true;
    }

    public function logout()
    {

        unset($_SESSION['user']);
    }

}