<?php

namespace App\Http\Controllers;

use App\Donasi;
use App\Donatur;
use App\Komunitas;
use App\Relawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DonaturController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$donatur = Donatur::where('user_id', Auth::user()->id)->first();
		$donasi = Donasi::where('donatur_id', $donatur->id)->get();
		return response()->json([
			'donasi' => $donasi
		]);
	}

	public function allDonatur()
	{
		$donatur = Donatur::all();
		$jmlDonatur = count($donatur);

		return response()->json([
			'jumlah_donatur' => $jmlDonatur
		]);
	}

	public function historyDonasi(){
		$donasi = Donasi::with('relawan.user', 'komunitas.user', 'penerimaDonasi')
		->join('table_komunitas', 'table_komunitas.id', 'table_donasi.komunitas_id')
		->join('users', 'users.id', 'table_donasi.komunitas_id')
		->select('table_donasi.*')
		->get();

		return response()->json([
			'donasi' => $donasi
		]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
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
