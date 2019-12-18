<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSensorTypesTable extends Migration {

	public function up()
	{
		Schema::create('sensor_types', function(Blueprint $table) {
			$table->integer('sensor_id')->unsigned();
			$table->integer('type_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('sensor_types');
	}
}