<?php

namespace App\Http\Controllers;

use App\Donasi;
use Illuminate\Http\Request;

class DonasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createDonasi(Request $request)
    {
        $donasicreds = validator($request->only('alamat_penjemputan', 'waktu_penjemputan', 'latitude', 'longitude'),[
			'alamat_penjemputan' => 'required|string',
			'waktu_penjemputan' => 'required',
			'latitude' => 'required',
			'longitude' => 'required'
		]);

		if ($donasicreds->fails()){
			return response()->json( $donasicreds->errors()->all(), 401);
		}

		$donasi = Donasi::create([
			'komunitas_id' => $request->komunitas_id,
			'donatur_id' => $request->donatur_id,
			'alamat_penjemputan' => $request->get('alamat_penjemputan'),
			'waktu_penjemputan' => $request->get('waktu_penjemputan'),
			'latitude' => $request->get('latitude'),
			'longitude' => $request->get('longitude'),
			'status' => "Menunggu Konfirmasi",
		]);

		$donasi->save();
		return response()->json([
			'message' => 'Donasi created',
			'donasi' => $donasi
		]);
	}
	
	public function updateRelawan(){

	}

	public function updatePenerima(){
		
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
