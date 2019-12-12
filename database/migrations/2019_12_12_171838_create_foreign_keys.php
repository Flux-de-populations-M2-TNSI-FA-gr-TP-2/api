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
		Schema::table('event_groups', function(Blueprint $table) {
			$table->foreign('event_id')->references('id')->on('events')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('event_groups', function(Blueprint $table) {
			$table->foreign('group_id')->references('id')->on('eventsGroups')
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
		Schema::table('group_users', function(Blueprint $table) {
			$table->foreign('group_id')->references('id')->on('eventsGroups')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('group_users', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('sensors', function(Blueprint $table) {
			$table->foreign('room_id')->references('id')->on('rooms')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::table('rooms', function(Blueprint $table) {
			$table->dropForeign('rooms_location_id_foreign');
		});
		Schema::table('event_groups', function(Blueprint $table) {
			$table->dropForeign('event_groups_event_id_foreign');
		});
		Schema::table('event_groups', function(Blueprint $table) {
			$table->dropForeign('event_groups_group_id_foreign');
		});
		Schema::table('event_location', function(Blueprint $table) {
			$table->dropForeign('event_location_event_id_foreign');
		});
		Schema::table('event_location', function(Blueprint $table) {
			$table->dropForeign('event_location_location_id_foreign');
		});
		Schema::table('group_users', function(Blueprint $table) {
			$table->dropForeign('group_users_group_id_foreign');
		});
		Schema::table('group_users', function(Blueprint $table) {
			$table->dropForeign('group_users_user_id_foreign');
		});
		Schema::table('sensors', function(Blueprint $table) {
			$table->dropForeign('sensors_room_id_foreign');
		});
	}
}