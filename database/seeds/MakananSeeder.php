<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MakananSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$makanan = [
			[1, 'Nasi Box'],
			[1, 'Roti'],
			[1, 'Buah Olahan'],
			[1, 'Lauk Pauk'],
			[1, 'Makanan Asin'],
			[1, 'Makanan Manis'],
			[1, 'Sayur Olahan'],

			[2, 'Sayur'],
			[2, 'Buah'],
			[2, 'Bahan Sembako'],

			[3, 'Susu'],
			[3, 'Bubur Bayi'],
			[3, 'Biskuit'],

			[4, 'Sereal & Oatmeal'],
			[4, 'Susu Sereal'],
			[4, 'Bubur Instan'],
			[4, 'Mie Instan'],
			[4, 'Sarden'],
			[4, 'Abon'],
			[4, 'Telur'],
			[4, 'Jelly / Agar-agar'],
			[4, 'Pasta'],
			[4, 'Sirup'],
			[4, 'SKM'],
			[4, 'Susu Bubuk'],

			[5, 'Keripik'],
			[5, 'Coklat']
		];

		for ($i = 0; $i < count($makanan); $i++) {
			DB::table('table_makanan')->insert([
				'jenis_makanan_id' => $makanan[$i][0],
				'nama_makanan' => $makanan[$i][1],
			]);
		}
	}
}
