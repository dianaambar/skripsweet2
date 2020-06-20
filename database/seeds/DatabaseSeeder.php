<?php

use App\JenisMakanan;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run()
	{
		// $this->call(UsersTableSeeder::class);
		$this->call(JenisMakananSeeder::class);
		$this->call(MakananSeeder::class);
		$this->call(RoleSeeder::class);
	}
}
