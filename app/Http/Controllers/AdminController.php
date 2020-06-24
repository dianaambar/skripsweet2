<?php

namespace App\Http\Controllers;

use App\Komunitas;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
	//
	public function accKomunitas($id)
	{
		//$user = User::join('table_komunitas', 'table_komunitas.user_id', 'users.id')
		//	->find($id);

		$user = User::find($id);

		//$komunitas = Komunitas::find($id);

		if ($user) {
			$user->status = true;
			$user->save();
		} else {
			return response()->json(["Komunitas doesn't exist"]);
		}
		$user->save();

		return response()->json([
			'komunitas' => $user
		]);
	}
}
