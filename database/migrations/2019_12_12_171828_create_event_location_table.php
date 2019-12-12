<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEventLocationTable extends Migration {

	public function up()
	{
		Schema::create('event_location', function(Blueprint $table) {
			$table->integer('event_id')->unsigned();
			$table->integer('location_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('event_location');
	}
}