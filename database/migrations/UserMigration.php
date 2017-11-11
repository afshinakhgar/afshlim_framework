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
            $table->string('first_name', 32);
            $table->string('last_name', 32);
            $table->string('segment_id', 32);
            $table->string('email')->unique();
            $table->string('password', 128);
            $table->string('code', 6);
            $table->rememberToken();
            $table->timestamps();
        });
    }
}