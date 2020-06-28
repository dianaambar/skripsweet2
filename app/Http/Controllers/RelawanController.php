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

	public function donasiRelawan()
	{
		$relawan = Relawan::where('user_id', Auth::user()->id)->first();
		//$donasi = Donasi::join('users', 'users.id', 'table_donasi.relawan_id')
		$dns = Donasi::with('makananDonasi.makanan.jenisMakanan')
			->join('table_donatur', 'table_donatur.id', 'table_donasi.donatur_id')
			->join('users', 'users.id', 'table_donatur.user_id')
			->select('table_donasi.*', 'users.name')
			->where('relawan_id', $relawan->id)
			->get();

		return response()->json([
			'donasi' => $dns
		]);
	}
}
