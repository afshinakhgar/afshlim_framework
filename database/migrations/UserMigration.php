<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 11/10/17
 * Time: 6:28 PM
 */

use Illuminate\Database\Capsule\Manager as Capsule;
use \Core\Interfaces\_Migrations;

class UserMigration extends _Migrations {
    function run()
    {
        $this->eloquent->schema()->dropIfExists('users');
        $this->eloquent->schema()->create('users', function($table) {
            $table->increments('id');
            $table->string('mobile');
            $table->string('email');
            $table->timestamps();
        });
    }
}