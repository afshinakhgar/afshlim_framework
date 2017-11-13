<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 11/10/17
 * Time: 6:19 PM
 */

namespace App\Model;
use Core\Interfaces\_Model;
use Illuminate\Database\Eloquent\Model;

class User extends _Model
{
    /**
     * User tokens relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tokens()
    {
        return $this->hasMany(Token::class);
    }
}