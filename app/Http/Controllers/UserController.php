<?php

namespace App\Http\Controllers;

use App\RoleUser;
use App\User;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;

class UserController extends Controller
{
	public function user()
	{
		//$user = Auth::user();
		$user = RoleUser::where('user_id', Auth::user()->id)
			->join('users', 'users.id', 'table_role_users.user_id')
			//->join('table_komunitas', 'table_komunitas.user_id', 'table_role_users.user_id')
			->first();

		return response()->json([
			//'user' => $user,
			'user' => $user
		]);
	}

	public function logoutApi()
	{
		if (Auth::check()) {
			Auth::user()->AauthAcessToken()->delete();
		}
	}
}
