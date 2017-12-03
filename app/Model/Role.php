<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 12/3/17
 * Time: 2:37 PM
 */

namespace App\Model;

use Core\Interfaces\_Model;

class Role extends _Model
{
    protected $fillable = [];


    /**
     * Many-to-Many relations with the user model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(\App\Model\User::class );
    }



}


