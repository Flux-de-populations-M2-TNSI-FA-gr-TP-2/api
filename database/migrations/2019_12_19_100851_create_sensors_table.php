<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSensorsTable extends Migration {

	public function up()
	{
		Schema::create('sensors', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('name', 255);
			$table->string('type', 255)->nullable();
			$table->text('token')->nullable();
			$table->integer('room_id')->unsigned()->nullable();
			$table->text('url')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('sensors');
	}
}