<?php

namespace App\Http\Controllers;

use App\PenerimaDonasi;
use Illuminate\Http\Request;

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
}
