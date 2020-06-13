<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$role = [
			['admin', 'all access'],
			['komunitas', 'Manage'],
			['relawan', 'Manage'],
			['donatur', 'Manage']
		];

		for ($i = 0; $i < count($role); $i++) {
			DB::table('table_role')->insert([
				'nama_role' => $role[$i][0],
				'description' => $role[$i][1]
			]);
		}
	}
}
