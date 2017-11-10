<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 11/10/17
 * Time: 6:28 PM
 */

use Illuminate\Database\Capsule\Manager as Capsule;
use \Core\Interfaces\_Migrations;
/**
 * Example migration for use with "novice"
 */
class UserMigration extends _Migrations {
    function run()
    {
        $this->db_el_orm->schema()->dropIfExists('users');
        $this->db_el_orm->schema()->create('users', function($table) {
            $table->increments('id');
            $table->string('mobile');
            $table->string('email');
            $table->timestamps();
        });
    }
}