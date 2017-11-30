<?php

use Phpmig\Migration\Migration;
use Illuminate\Database\Capsule\Manager as Capsule;

class AddPasswordToUsersTableMigration extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        Capsule::schema()->table('users', function($table)
        {
            $table->string('password',128);
        });
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        Capsule::schema()->table('users', function($table)
        {
            $table->drop('password');
        });
    }
}