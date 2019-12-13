<?php

use Illuminate\Database\Seeder;
use App\Event;

class EventTableSeeder extends Seeder {

	public function run()
	{
		//DB::table('events')->delete();

		// Fermeture du RU 2
		Event::create(array(
				'name' => 'Fermeture du RU 2',
				'start' => '2019-12-11 08:00:00',
				'end' => '2019-12-12 08:00:00',
				'status' => 'Terminé'
			));
	}
}
