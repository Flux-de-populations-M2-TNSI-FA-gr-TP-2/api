<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder {

	public function run()
	{
		//DB::table('users')->delete();

		// user1
		User::create(array(
				'firstname' => 'Jane',
				'lastname' => 'Doe',
				'email' => '1@test.com',
				'password' => Hash::make('1234'),
				'role' => 'user'
			));

		// user2
		User::create(array(
				'firstname' => 'John',
				'lastname' => 'Doe',
				'email' => '2@test.com',
				'password' => Hash::make('1234'),
				'role' => 'admin'
			));
	}
}
