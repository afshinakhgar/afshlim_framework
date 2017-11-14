<?php
use Illuminate\Database\Capsule\Manager as Capsule;
use Core\Interfaces\_Migration;
use Illuminate\Database\Schema\Blueprint as Blueprint;
class CreateUsersMigration extends _Migration
{
    /**
     * Do the migration
     */
    function up()
    {
        $this->eloquent->schema()->create('users', function($table) {
            $table->increments('id');
            $table->string('first_name', 32);
            $table->string('last_name', 32);
            $table->string('email')->unique();
            $table->string('password', 128);
            $table->string('token', 128);
            $table->string('code', 6);
            $table->enum('has_pic', ['yes','no'])->default('no');
            $table->rememberToken();
            $table->timestamps();
        });
    }
    /**
     * Undo the migration
     */
    public function down()
    {
        $this->eloquent->schema()->drop('users');
    }
}