<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 11/12/17
 * Time: 5:16 PM
 */

namespace App\Model;


use Core\Interfaces\_Model;

class Token extends _Model
{

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}