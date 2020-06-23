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

	public function closestRelawan($latitude, $longitude)
	{
		$sqlDistance = DB::raw('( 6371 * acos( cos( radians(' . $latitude . ') ) 
            * cos( radians( latitude ) ) 
            * cos( radians( longitude ) 
            - radians(' . $longitude  . ') ) 
            + sin( radians(' . $latitude  . ') ) 
            * sin( radians( latitude ) ) ) )');
		//return $sqlDistance;

		$kom = Komunitas::where('user_id', Auth::user()->id)->first();
		$relawan =  Relawan::select('*')->selectRaw("{$sqlDistance} AS distance")
			->where('komunitas_id', $kom)
			->orderBy('distance')
			->get(); //get users

		return response()->json([
			'relawan' => $relawan
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
