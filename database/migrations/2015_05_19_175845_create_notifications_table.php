<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('body');
            $table->string('type'); //message_reply, status_comment, comment_reply, first_message etc
            $table->integer('user_id')->unsigned()->index();
            $table->string('status')->default('unread'); // read/unread,archived
            $table->timestamp('read_at')->nullable()->default(null);
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
        Schema::drop('notifications');
    }
}
