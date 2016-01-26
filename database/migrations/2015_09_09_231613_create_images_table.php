<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function(Blueprint $table){
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->string('name')->nullable();
            $table->string('caption')->nullable();
            $table->string('path')->default('images/aavatar/dummy/aavatar.png');
            $table->string('thumbnail_path')->default('images/aavatar/dummy/tn-aavatar.png');
            $table->string('icon_path')->default('images/aavatar/dummy/ico-aavatar.png');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
          Schema::drop('images');
    }
}
