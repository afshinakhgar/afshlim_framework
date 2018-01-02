<?php

use Phpmig\Migration\Migration;
use Illuminate\Database\Capsule\Manager as Capsule;

class CreateCategoriesTableMigration extends Migration
{
    /**
     * Do the migration
     */
    public function up()
    {
        Capsule::schema()->create('categories', function ($table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->string('slug')->unique();
            $table->text('body')->nullable();
            $table->integer('item_cnt')->unsigned()->default(0);
            $table->enum('is_active',['yes','no'])->default('yes');
            $table->enum('has_pic',['yes','no'])->default('no');

            $table->string('meta_title',128)->nullable();
            $table->string('meta_description',256)->nullable();
            $table->string('meta_keywords',64)->nullable();

            /*Add Soft Delete To Articles*/
            $table->softDeletes();
            $table->timestamps();
        });


    }

    /**
     * Undo the migration
     */
    public function down()
    {
        Capsule::schema()->drop('categories');
    }
}