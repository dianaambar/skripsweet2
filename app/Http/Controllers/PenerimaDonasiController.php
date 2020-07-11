<?php

namespace App\Http\Controllers;

use App\PenerimaDonasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenerimaDonasiController extends Controller
{
    public function createReport(Request $request){
		$reportCreds = validator($request->only('nama_penerima', 'alamat_penerima', 'foto', 'latitude', 'longitude'), [
			'nama_penerima' => 'required|string',
			'alamat_penerima' => 'required|string',
			'foto' => 'required',
			'latitude' => 'required',
			'longitude' => 'required'
		]);

		if ($reportCreds->fails()){
			return response()->json( $reportCreds->errors()->all(), 401 );
		}

		$penerimaDonasi = new PenerimaDonasi;
		$penerimaDonasi->nama_penerima = $request->get('nama_penerima');
		$penerimaDonasi->alamat_penerima = $request->get('alamat_penerima');
		$penerimaDonasi->foto = $request->get('foto');
		$penerimaDonasi->latitude = $request->get('latitude');
		$penerimaDonasi->longitude = $request->get('longitude');
		$penerimaDonasi->save();

		return response()->json([
			'penerimadonasi' => $penerimaDonasi
		]);
	}

	public function closestPenerimaDonasi(Request $request)
	{
		// $penerimaDonasi = new PenerimaDonasi;
		$latitude = $request->get('latitude');
		$longitude = $request->get('longitude');
		$radius = $request->get('radius');

		$penerimaDonasi = DB::select('select * from (select nama_penerima, alamat_penerima, latitude, longitude, ( 6371 * acos( cos( radians('.$latitude.') ) 
		* cos( radians( latitude ) ) 
		* cos( radians( longitude ) 
		- radians('.$longitude.') ) 
		+ sin( radians('.$latitude.') ) 
		* sin( radians( latitude ) ) ) ) as jarak
		from table_penerima_donasi) AS distance
		where jarak < '.$radius.'
		order by jarak');
            //return $sqlDistance;
	
			return response()->json([
				'penerimadonasi' => $penerimaDonasi
			]);
	}

	public function showPenerima(){
		// $makanan = Makanan::all();
		$penerimaDonasi = PenerimaDonasi::all();

		return response()->json([
			'penerimaDonasi' => $penerimaDonasi
		]);
	}
}
