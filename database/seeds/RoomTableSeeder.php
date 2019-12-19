<?php

use Illuminate\Database\Seeder;
use App\Room;

class RoomTableSeeder extends Seeder {

	public function run()
	{
		//DB::table('rooms')->delete();

		// 108E
		Room::create(array(
				'name' => '108E',
				'floor' => '1',
				'location_id' => 2
			));

		// 112E
		Room::create(array(
				'name' => '112E',
				'floor' => '1',
				'location_id' => 2
			));
	}
}