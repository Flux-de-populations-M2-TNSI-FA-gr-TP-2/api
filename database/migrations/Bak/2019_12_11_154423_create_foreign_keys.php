<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('rooms', function(Blueprint $table) {
			$table->foreign('location_id')->references('id')->on('locations')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('event_user', function(Blueprint $table) {
			$table->foreign('event_id')->references('id')->on('events')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('event_user', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('event_location', function(Blueprint $table) {
			$table->foreign('event_id')->references('id')->on('events')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('event_location', function(Blueprint $table) {
			$table->foreign('location_id')->references('id')->on('locations')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::table('rooms', function(Blueprint $table) {
			$table->dropForeign('rooms_location_id_foreign');
		});
		Schema::table('event_user', function(Blueprint $table) {
			$table->dropForeign('event_user_event_id_foreign');
		});
		Schema::table('event_user', function(Blueprint $table) {
			$table->dropForeign('event_user_user_id_foreign');
		});
		Schema::table('event_location', function(Blueprint $table) {
			$table->dropForeign('event_location_event_id_foreign');
		});
		Schema::table('event_location', function(Blueprint $table) {
			$table->dropForeign('event_location_location_id_foreign');
		});
	}
}