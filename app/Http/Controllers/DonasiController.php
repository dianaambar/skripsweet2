<?php

namespace App\Http\Controllers;

use App\Donasi;
use App\Donatur;
use App\Komunitas;
use App\MakananDonasi;
use App\PenerimaDonasi;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Auth;

class DonasiController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{

		$kom = Komunitas::where('user_id', Auth::user()->id)->first();
		$dns = Donasi::with('makananDonasi.makanan.jenisMakanan', 'relawan.user')
			->join('table_donatur', 'table_donatur.id', 'table_donasi.donatur_id')
			->join('users', 'users.id', 'table_donatur.user_id')
			->select('table_donasi.*', 'users.name')
			->where('komunitas_id', $kom->id)
			->get();

		//$dns = Donasi::with('makananDonasi')->where('komunitas_id', $kom->id)->get();
		//for($i = 0;$i<count($dns);$i++){
		//	for($j = 0;$j<count($dns[$i]['makanan_donasi']);$j++){
		//		$dns[$i]['makanan_donasi'][$j]['nama_makanan'] = $dns[$i]['makanan_donasi'][$j]->makanan['nama_makanan'];
		//		$dns[$i]['makanan_donasi'][$j]['jenis_makanan'] = $$dns[$i]['makanan_donasi'][$j]->makanan->jenis_makanan->nama_jenis;
		//	}
		//}

		//$komunitas = User::find(Auth::user()->id)->name;
		return response()->json([
			'donasi' => $dns
		]);

		//$listdonasi = Donasi::select()

		//return Auth::user();
		//return $kom;
	}

	public function showDetail($id)
	{
		$kom = Komunitas::where('user_id', Auth::user()->id)->first();
		$dns = Donasi::with('makananDonasi.makanan.jenisMakanan', 'relawan.user', 'penerimaDonasi')
			->join('table_donatur', 'table_donatur.id', 'table_donasi.donatur_id')
			//->join('table_relawan', 'table_relawan.id', 'table_donasi.relawan_id')
			->join('users', 'users.id', 'table_donatur.user_id')
			//->join('table_penerima_donasi', 'table_penerima_donasi.id', 'table_donasi.penerima_id')
			//->join('users', 'users.id', 'table_relawan.user_id')
			->select('table_donasi.*', 'users.name')
			->where('komunitas_id', $kom->id)
			->where('table_donasi.id', $id)
			->first();

		return response()->json([
			'donasi' => $dns
		]);
	}

	public function listDonasi()
	{
		$kom = Komunitas::where('user_id', Auth::user()->id)->first();
		$dns = Donasi::join('table_donatur', 'table_donatur.id', 'table_donasi.donatur_id')
			->join('users', 'users.id', 'table_donatur.user_id')
			->where('komunitas_id', $kom->id)
			->get();

		return response()->json([
			'donasi' => $dns
		]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function createDonasi(Request $request)
	{
		$donasicreds = validator($request->only('alamat_penjemputan', 'waktu_penjemputan', 'latitude', 'longitude', 'tgl_produksi', 'tgl_kadaluwarsa', 'jumlah', 'unit', 'jamur', 'bau', 'berbau', 'berwarna', 'berubahrasa', 'berubahtekstur', 'notes'), [
			'alamat_penjemputan' => 'required|string',
			'waktu_penjemputan' => 'required',
			'latitude' => 'required',
			'longitude' => 'required',
			'tgl_produksi' => 'required',
			'tgl_kadaluwarsa' => 'required',
			'jumlah' => 'required',
			'unit' => 'required',
			'jamur',
			'bau',
			'berwarna',
			'berubahrasa',
			'berubahtekstur',
			'notes'
		]);

		if ($donasicreds->fails()) {
			return response()->json($donasicreds->errors()->all(), 401);
		}

		$donasi = new Donasi;
		$donasi->komunitas_id = $request->komunitas_id;
		$donasi->donatur_id = $request->donatur_id;
		$donasi->alamat_penjemputan = $request->get('alamat_penjemputan');
		$donasi->waktu_penjemputan = $request->get('waktu_penjemputan');
		$donasi->latitude = $request->get('latitude');
		$donasi->longitude = $request->get('longitude');
		$donasi->status = "Menunggu Konfirmasi";
		$donasi->save();

		$makananDonasi = new MakananDonasi;
		$makananDonasi->makanan_id = $request->makanan_id;
		$makananDonasi->donasi_id = $donasi->id;
		$makananDonasi->jumlah = $request->get('jumlah');
		$makananDonasi->unit = $request->get('unit');
		$makananDonasi->tgl_kadaluwarsa = $request->get('tgl_kadaluwarsa');
		$makananDonasi->tgl_produksi = $request->get('tgl_produksi');
		$makananDonasi->jamur = $request->get('jamur');
		$makananDonasi->bau = $request->get('bau');
		$makananDonasi->berwarna = $request->get('berwarna');
		$makananDonasi->berubahrasa = $request->get('berubahrasa');
		$makananDonasi->berubahtekstur = $request->get('berubahtekstur');
		$makananDonasi->notes = $request->get('notes');
		$makananDonasi->save();

		return response()->json([
			'message' => 'Donasi created',
			'donasi' => $donasi,
			'makanandonasi' => $makananDonasi,
		]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function updateDonasi($id)
	{

		$donasi = Donasi::find($id);

		if ($donasi) {
			$donasi->status = "Donasi diterima, Mencari Relawan";
			$donasi->save();
		}

		return response()->json([
			'updatedonasi' => $donasi
		]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function findRelawan(Request $request, $id)
	{
		//$credsrelawan = validator($request->only('relawan_id'), [
		//	'relawan_id' => 'required'
		//]);

		//if ($credsrelawan->fails()) {
		//	return response()([
		//		'message' => 'Relawan tidak tersedia'
		//	]);
		//}

		$donasi = Donasi::find($id);

		if ($donasi) {
			$donasi->relawan_id = $request->relawan_id;
			$donasi->status = "Menunggu konfirmasi relawan";
			$donasi->save();
		}

		return response()->json([
			'message' => 'Donasi berhasil di update',
			'updatedonasi' => $donasi
		]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function accRelawan(Request $request, $id)
	{
		//$accCreds = validator($request->only('accDonasi'), [
		//	'accDonasi' => 'required'
		//]);

		//if ($accCreds->fails()) {
		//	return response()->json($accCreds->errors()->all(), 401);
		//}

		$donasi = Donasi::find($id);

		if ($donasi) {
			$donasi->accDonasi = $request->get('accDonasi');
			$acc = $donasi->accDonasi;

			if ($acc == true) {
				$donasi->status = "Makanan akan dijemput oleh Relawan";
				//$donasi->save();
			} else {
				$donasi->status = "Menunggu konfirmasi Relawan";
				$donasi->relawan_id = null;
				//$donasi->save();
			}
		}
		$donasi->save();

		return response()->json([
			'message' => 'Donasi berhasil di update',
			'updatedonasi' => $donasi
		]);
	}



	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function updatePenerimaDonasi(Request $request, $id)
	{
		$credspenerima = validator($request->only('nama_penerima', 'alamat_penerima', 'foto', 'latitude', 'longitude'), [
			'nama_penerima' => 'required|string',
			'alamat_penerima' => 'required|string',
			'foto' => 'required',
			'latitude' => 'required|string',
			'longitude' => 'required|string'
		]);

		if ($credspenerima->fails()) {
			return response()([
				'message' => 'Error'
			]);
		}

		$penerimaDonasi = new PenerimaDonasi;
		$penerimaDonasi->nama_penerima = $request->get('nama_penerima');
		$penerimaDonasi->alamat_penerima = $request->get('alamat_penerima');
		$penerimaDonasi->foto = $request->get('foto');
		$penerimaDonasi->latitude = $request->get('latitude');
		$penerimaDonasi->longitude = $request->get('longitude');
		$penerimaDonasi->save();

		$donasi = Donasi::find($id);

		if ($donasi) {
			$donasi->penerima_id = $penerimaDonasi->id;
			$donasi->status = "Donasi telah disalurkan";
			$donasi->save();
		}

		return response()->json([
			'updatedonasi' => $donasi
		]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		//
	}
}
