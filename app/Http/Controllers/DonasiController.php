<?php

namespace App\Http\Controllers;

use App\Donasi;
use App\Donatur;
use App\Komunitas;
use App\PenerimaDonasi;
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
		$dns = Donasi::where('komunitas_id',$kom->id)->get();
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

	/**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
	public function updateDonasi($id){

		$donasi = Donasi::find($id);

		if($donasi){
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
	public function findRelawan(Request $request, $id){
		$credsrelawan = validator($request->only('relawan_id'), [
			'relawan_id' => 'required'
		]);

		if ($credsrelawan->fails()){
			return response()([
				'message' => 'Relawan tidak tersedia'
			]);
		}

		$donasi = Donasi::find($id);

		if ($donasi){
			$donasi->relawan_id = $request->get('relawan_id');
			$donasi->status = "Makanan akan dijemput oleh relawan";
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
	public function updatePenerimaDonasi(Request $request, $id){
		$credspenerima = validator($request->only('penerima_id'), [
			'penerima_id' => 'required'
		]);

		if ($credspenerima->fails()){
			return response()([
				'message' => 'Relawan tidak tersedia'
			]);
		}

		$donasi = Donasi::find($id);

		if($donasi){
			$donasi->penerima_id = $request->get('penerima_id');
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
