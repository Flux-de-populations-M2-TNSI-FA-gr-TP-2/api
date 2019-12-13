<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEventGroupsTable extends Migration {

	public function up()
	{
		Schema::create('event_groups', function(Blueprint $table) {
			$table->integer('event_id')->unsigned();
			$table->integer('group_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('event_groups');
	}
}