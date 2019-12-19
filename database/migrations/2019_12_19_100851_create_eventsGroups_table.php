<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEventsGroupsTable extends Migration {

	public function up()
	{
		Schema::create('eventsGroups', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('name', 255);
			$table->string('restriction', 255)->nullable();
		});
	}

	public function down()
	{
		Schema::drop('eventsGroups');
	}
}