<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 11/24/17
 * Time: 1:11 PM
 */

namespace Core\Service;

use App\DataAccess\User\UserDataAccess;
use Core\Interfaces\_Service;

class AuthService extends _Service
{
    public function user()
    {
        return UserDataAccess::getUserById(isset($_SESSION['userid']) ? $_SESSION['userid'] : 0);

    }

    public function check()
    {
        return isset($_SESSION['user']);
    }

    public function attempt(string $username, string $email,string $mobile,string $password)
    {
        $user = UserDataAccess::getUserByEmail_OR_Mobile_OR_Username_one_r($username,$email,$mobile)->first();

        if (!$user) {
            return false;
        }
        if (password_verify($password,$user->password)) {
            $_SESSION['user'] = $user->id;
            return true;
        }
        return false;
    }

    public function logout()
    {
        unset($_SESSION['user']);
    }

}