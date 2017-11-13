<?php
namespace Database\Migration;

use Illuminate\Database\Capsule\Manager as Capsule;
use Core\Interfaces\_Migration;
use Illuminate\Database\Schema\Blueprint as Blueprint;
class UserMigration extends _Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        $this->schema->create('user', function(Blueprint $table)
        {
            $table->increments('id');
            
            $table->timestamps();
        });
    }
    /**
     * Undo the migration
     */
    public function down()
    {
        $this->schema->drop('user');
    }
}