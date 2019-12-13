<?php

use Illuminate\Database\Seeder;
use App\Location;

class LocationTableSeeder extends Seeder {

	public function run()
	{
		//DB::table('locations')->delete();

		// ISTV1
		Location::create(array(
				'name' => 'ISTV1',
				'address' => 'Campus Mont Houy'
			));

		// ISTV2
		Location::create(array(
				'name' => 'ISTV2',
				'address' => 'Campus Mont Houy'
			));

		// ISTV3
		Location::create(array(
				'name' => 'ISTV3',
				'address' => 'Campus Mont Houy'
			));

		// RU2
		Location::create(array(
				'name' => 'RU2',
				'address' => 'Campus Mont Houy'
			));

		// RU1
		Location::create(array(
				'name' => 'RU1',
				'address' => 'Campus Mont Houy'
			));

		// Parking 1
		Location::create(array(
				'name' => 'Parking 1',
				'address' => 'Campus Mont Houy'
			));

		// Parking 2
		Location::create(array(
				'name' => 'Parking 2',
				'address' => 'Campus Mont Houy'
			));
	}
}