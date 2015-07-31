<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->integer('employee_id')->unsigned()->unique();
			$table->string('mobile', 20)->index();
			$table->date('dob')->nullable();
			$table->string('designation', 100)->nullable();
			$table->string('current_branch', 20)->nullable()->index();
			$table->integer('login_count')->default(0);
			$table->string('email')->unique();
			$table->string('password', 60);
			$table->string('avatar')->nullable();
			$table->json('settings');
			$table->rememberToken();
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
		Schema::drop('users');
	}

}
