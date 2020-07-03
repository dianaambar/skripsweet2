<?php

namespace App\Http\Controllers;

use App\Donasi;
use App\Komunitas;
use App\Relawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RelawanController extends Controller
{
	public function index()
	{
		$kom = Komunitas::where('user_id', Auth::user()->id)->first();
		$relawan = Relawan::join('users', 'users.id', 'table_relawan.user_id')
			->where('komunitas_id', $kom->id)
			->where('status', false)
			->get();

		return response()->json([
			'relawan' => $relawan
		]);
	}

	public function allRelawan()
	{
		$relawan = Relawan::all();
		$jmlRelawan = count($relawan);

		return response()->json([
			'relawan' => $relawan,
			'jumlah_relawan' => $jmlRelawan
		]);
	}

	public function showDataRelawan($id)
	{
		$relawan = Relawan::join('users', 'users.id', 'table_relawan.user_id')
			->where('table_relawan.id', $id)
			->select('table_relawan.*', 'users.name', 'users.alamat', 'users.no_telp')
			->first();

		return response()->json([
			'relawan' => $relawan
		]);
	}

	public function donasiRelawan()
	{
		$relawan = Relawan::where('user_id', Auth::user()->id)->first();
		//$donasi = Donasi::join('users', 'users.id', 'table_donasi.relawan_id')
		$dns = Donasi::with('makananDonasi.makanan.jenisMakanan')
			->join('table_donatur', 'table_donatur.id', 'table_donasi.donatur_id')
			->join('users', 'users.id', 'table_donatur.user_id')
			->select('table_donasi.*', 'users.name')
			->where('relawan_id', $relawan->id)
			->where('accDonasi', false)
			->get();

		return response()->json([
			'donasi' => $dns
		]);
	}

	public function acceptByRelawan()
	{
		$relawan = Relawan::where('user_id', Auth::user()->id)->first();
		//$donasi = Donasi::join('users', 'users.id', 'table_donasi.relawan_id')
		$dns = Donasi::with('makananDonasi.makanan.jenisMakanan')
			->join('table_donatur', 'table_donatur.id', 'table_donasi.donatur_id')
			->join('users', 'users.id', 'table_donatur.user_id')
			->select('table_donasi.*', 'users.name')
			->where('relawan_id', $relawan->id)
			->where('accDonasi', true)
			->get();

		return response()->json([
			'donasi' => $dns
		]);
	}

	public function updateLatLong(Request $request, $id)
	{

		$relawan = Relawan::find($id);

		if ($relawan) {
			$relawan->latitude = $request->get('latitude');
			$relawan->longitude = $request->get('longitude');
		}
		$relawan->save();

		return response()->json([
			'message' => 'Location updated',
			'relawan' => $relawan
		]);
	}
}
