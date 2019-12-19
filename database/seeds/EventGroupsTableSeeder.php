<?php

use Illuminate\Database\Seeder;
use App\EventGroups;
use App\GroupLocation;

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

		GroupLocation::create(array(
			'group_id' => 2,
			'location_id' => 2
		));
		
		GroupLocation::create(array(
			'group_id' => 1,
			'location_id' => 5
		));
	}
}
