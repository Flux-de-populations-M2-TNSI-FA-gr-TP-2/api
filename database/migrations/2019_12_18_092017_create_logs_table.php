<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLogsTable extends Migration {

	public function up()
	{
		Schema::create('logs', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->text('data');
			$table->string('name', 255)->nullable();
			$table->integer('location_id')->unsigned()->nullable();
		});
	}

	public function down()
	{
		Schema::drop('logs');
	}
}