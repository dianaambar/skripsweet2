<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;

class UserController extends Controller
{
	public function user()
	{
		$user = Auth::user();

		return response()->json([
			'user' => $user
		]);
	}
}
