<?php

use Illuminate\Database\Seeder;
use App\EventGroupsLink;

class EventGroupsLinkTableSeeder extends Seeder {

	public function run()
	{
		//DB::table('event_groups')->delete();

		// RU - Fermeture
		EventGroupsLink::create(array(
				'event_id' => 1,
				'group_id' => 2
			));
	}
}