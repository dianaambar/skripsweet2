<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

	use AuthenticatesUsers;
	
	public function login(Request $request){
		$login = $request->validate([
			'email' => 'required|string',
			'password' => 'required|string'
		]);

		if ( !Auth::attempt($login) ) {
			return response([
				'message' => 'invalid login credentials'
			]);
		}

		$accessToken = Auth::user()->createToken('authToken')->accessToken;

		return response([
			'user' => Auth::user(),
			'access_token' => $accessToken
		]);
	}

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
