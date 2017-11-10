<?php
/**
 * Created by PhpStorm.
 * User: afshin
 * Date: 11/10/17
 * Time: 6:28 PM
 */

use Illuminate\Database\Capsule\Manager as Capsule;
use \Core\Interfaces\_Migrations;


class TestMigration extends _Migrations {
    function run()
    {
        $this->eloquent->schema()->dropIfExists('tests');
        $this->eloquent->schema()->create('tests', function($table) {
            $table->increments('id');
            $table->string('name', 32);
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->rememberToken();
            $table->timestamps();
        });
    }
}