<?php

use Phpmig\Migration\Migration;
use Illuminate\Database\Capsule\Manager as Capsule;

class AddHasPicToUsersTableMigration extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        Capsule::schema()->table('users', function($table)
        {
            $table->enum('has_pic',['no','yes'])->default('no');
        });
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        Capsule::schema()->table('users', function($table)
        {
            $table->drop('has_pic');
        });
    }
}