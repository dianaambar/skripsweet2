<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisMakananSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$jenismakanan = [
			['Makanan Jadi'],
			['Bahan Dasar'],
			['Makanan Bayi/Anak'],
			['Makanan Instan'],
			['Makanan Ringan'],
		];

		for ($i = 0; $i < count($jenismakanan); $i++) {
			DB::table('table_jenis_makanan')->insert([
				'nama_jenis_makanan' => $jenismakanan[$i][0],
			]);
		}
	}
}
