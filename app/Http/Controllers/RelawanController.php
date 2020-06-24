<?php

namespace App\Http\Controllers;

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
}
