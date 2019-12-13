<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	public function up()
	{
		Schema::create('users', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('firstname', 255);
			$table->string('lastname', 255);
			$table->string('email', 255)->unique();
			$table->text('password');
			$table->date('birthdate')->nullable();
			$table->string('role', 255);
		});
	}

	public function down()
	{
		Schema::drop('users');
	}
}