<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEventUserTable extends Migration {

	public function up()
	{
		Schema::create('event_user', function(Blueprint $table) {
			$table->integer('event_id')->unsigned();
			$table->integer('user_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('event_user');
	}
}