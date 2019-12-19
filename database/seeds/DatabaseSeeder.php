<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	public function run()
	{
		Model::unguard();

		$this->call([UserTableSeeder::class]);
		$this->command->info('User table seeded!');

		$this->call([EventTableSeeder::class]);
		$this->command->info('Event table seeded!');

		$this->call([LocationTableSeeder::class]);
		$this->command->info('Location table seeded!');

		$this->call([RoomTableSeeder::class]);
		$this->command->info('Room table seeded!');

		$this->call([EventGroupsTableSeeder::class]);
		$this->command->info('EventGroups table seeded!');

		$this->call([EventGroupsLinkTableSeeder::class]);
		$this->command->info('EventGroupsLink table seeded!');
	}
}
