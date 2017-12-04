<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 11/24/17
 * Time: 12:20 AM
 */

namespace App\DataAccess\User;


use App\Model\Role;
use App\Model\Token;
use Core\Helpers\Hash;
use Core\Interfaces\_DataAccess;
use PDO;
use App\Model\User;

/**
 * @param UserDataAccess
 */

class RoleDataAccess extends _DataAccess
{
    /**
     * @param string $loginField
     * @return User
     */
    public static function getAllRoles(int $limit = 20)
    {
        return Role::paginate($limit);
    }

    /**
     * @param integer $role_id
     * @return User
     */
    public static function getRoleById(int $role_id)
    {
        $role = Role::find($role_id);
        $list = [];
        if(isset($role->id)){
            $list = $role->users()->get();
        }


        return $list;
    }


    public static function createRole($params)
    {
        $role = new Role();
        $role->name = $params['name'];
        $role->display_name = $params['display_name'];
        $role->description = $params['description'] ? $params['description'] : '';

        $role->save();
    }


}