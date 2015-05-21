<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		$this->call('UsersTableSeeder');

	}

}



class UsersTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		DB::table('users')->delete();

		$users = array(
			'username' => 'admin',
			'email'    => 'admin@example.com',
			'password' => Hash::make('password'),
			'created_at' => new DateTime,
			'updated_at' => new DateTime,
		);

		DB::table('users')->insert($users);
	}

}
