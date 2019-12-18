<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGroupLocationTable extends Migration {

	public function up()
	{
		Schema::create('group_location', function(Blueprint $table) {
			$table->integer('group_id')->unsigned();
			$table->integer('location_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('group_location');
	}
}