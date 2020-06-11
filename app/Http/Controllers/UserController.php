<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;

class UserController extends Controller
{
    public function user(){
		$user = User::find(Auth::user()->id);

		return response()->json([
            'data' => $user
		]);
	}
}
