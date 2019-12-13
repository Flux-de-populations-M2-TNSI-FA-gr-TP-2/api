<?php

use Illuminate\Database\Seeder;
use App\EventLocation;

class EventLocationTableSeeder extends Seeder {

	public function run()
	{
		//DB::table('event_location')->delete();

		// Fermeture du RU 2
		EventLocation::create(array(
				'event_id' => 1,
				'location_id' => 4
			));
	}
}