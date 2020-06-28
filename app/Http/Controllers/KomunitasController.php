<?php

namespace App\Http\Controllers;

use App\Donasi;
use App\Komunitas;
use App\Relawan;
use App\RoleUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KomunitasController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getRelawan()
	{
		$kom = Komunitas::where('user_id', Auth::user()->id)->first();
		$relawan = Relawan::join('users', 'users.id', 'table_relawan.user_id')
			->select('table_relawan.*', 'users.name', 'users.alamat', 'users.no_telp')
			->where('komunitas_id', $kom->id)
			->where('status', true)->get();

		$semua = Relawan::join('users', 'users.id', 'table_relawan.user_id')
			->select('table_relawan.*', 'users.name', 'users.alamat', 'users.no_telp')
			->where('komunitas_id', $kom->id)
			->get();

		return response()->json([
			'relawan' => $relawan,
			'semua' => $semua
		]);
	}

	public function accRelawan($id)
	{
		//$kom = Komunitas::where('user_id', Auth::user()->id)->first();
		//$relawan = Relawan::join('users', 'users.id', 'table_relawan.user_id')->find($id);
		//$user = User::join('table_relawan', 'table_relawan.user_id', 'users.id')
		//	->where('table_relawan.user_id', $relawan->id)
		//	->first();
		$user = User::find($id);
		//$user = User::join('table_relawan', 'table_relawan.user_id', 'users.id')
		//	->select('table_relawan.*')
		//	->find($id);

		if ($user) {
			//$user = User;
			$user->status = true;
			$user->save();
		} else {
			return response()->json(['Relawan doesnt exist']);
		}

		return response()->json([
			'user' => $user
		]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function nonAccKomunitas()
	{
		$komunitas = Komunitas::join('users', 'users.id', 'table_komunitas.user_id')
			->where('status', false)
			->get();

		return response()->json([
			'komunitas' => $komunitas,
		]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function showKomunitas()
	{
		$komunitas = Komunitas::join('users', 'users.id', 'table_komunitas.user_id')
			->where('status', true)
			->get();

		$jmlKom = count($komunitas);

		return response()->json([
			'komunitas' => $komunitas,
			'jumlah_komunitas' => $jmlKom
		]);
	}

	public function allTransactions()
	{
		$dns = Donasi::with('makananDonasi.makanan.jenisMakanan', 'relawan.user', 'penerimaDonasi', 'komunitas')
			->join('table_donatur', 'table_donatur.id', 'table_donasi.donatur_id')
			//->join('table_relawan', 'table_relawan.id', 'table_donasi.relawan_id')
			->join('users', 'users.id', 'table_donatur.user_id')
			//->join('table_penerima_donasi', 'table_penerima_donasi.id', 'table_donasi.penerima_id')
			//->join('users', 'users.id', 'table_relawan.user_id')
			->select('table_donasi.*', 'users.name')
			//->where('komunitas_id', $kom->id)
			//->where('table_donasi.id', $id)
			->get();

		return response()->json([
			'donasi' => $dns
		]);
	}

	public function dataKomunitas()
	{
		$komunitas = Komunitas::where('user_id', Auth::user()->id)
			->join('users', 'users.id', 'table_komunitas.user_id')
			->first();

		return response()->json([
			'komunitas' => $komunitas
		]);
	}

	public function closestRelawan($latitude, $longitude)
	{
		//$sqlDistance = DB::raw('( 6371 * acos( cos( radians(' . $latitude . ') ) 
		//    * cos( radians( latitude ) ) 
		//    * cos( radians( longitude ) 
		//    - radians(' . $longitude  . ') ) 
		//    + sin( radians(' . $latitude  . ') ) 
		//    * sin( radians( latitude ) ) ) )');
		//return $sqlDistance;

		//$relawan =  Relawan::select('*')->selectRaw("{$sqlDistance} AS distance")
		//	->where('komunitas_id', $kom)
		//	->orderBy('distance')
		//	->get(); //get users
		//$kom = DB::table('table_komunitas')
		//	->where('user_id', Auth::user()->id)->first();

		$kom = Komunitas::where('user_id', Auth::user()->id)->first();
		$relawan = DB::select(
			'select * from
			(select id, user_id, nama_panggilan, jenis_kelamin, komunitas_id, ( 6371 * acos( cos( radians(' . $latitude . ') ) 
						* cos( radians( latitude ) ) 
						* cos( radians( longitude ) 
						- radians(' . $longitude . ') ) 
						+ sin( radians(' . $latitude . ') ) 
						* sin( radians( latitude ) ) ) ) 
						AS distance
						from table_relawan) As tr
						Inner join users 
						on users.id = tr.user_id
						where tr.komunitas_id = ' . $kom->id . '		
						order by distance'
		);

		return response()->json([
			'relawan' => $relawan
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
