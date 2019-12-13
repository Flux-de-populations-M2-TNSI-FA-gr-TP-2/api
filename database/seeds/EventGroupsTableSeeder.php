<?php

use Illuminate\Database\Seeder;
use App\EventGroups;

class EventGroupsTableSeeder extends Seeder {

	public function run()
	{
		//DB::table('eventsGroups')->delete();

		// Admin
		EventGroups::create(array(
				'name' => 'Admin',
				'restriction' => 'admin'
			));

		// RU
		EventGroups::create(array(
				'name' => 'RU'
			));
	}
}