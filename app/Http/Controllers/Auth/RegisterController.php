<?php

namespace App\Http\Controllers\Auth;

use App\Donatur;
use App\User;
use App\Http\Controllers\Controller;
use App\Komunitas;
use App\Relawan;
use App\RoleUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

	use RegistersUsers;
	
	public function register(Request $request){
		$credentials = validator($request->only('name', 'email', 'password', 'no_telp', 'alamat'), [
			'name' => 'required|string',
			'email' => 'required|string|min:6|max:50|unique:users',
			'password' => 'required|string',
			'no_telp'  => 'required|string',
			'alamat' => 'required|string',
		]);

		if ($credentials->fails()){
			return response()->json( $credentials->errors()->all(), 401 );
		}

		$user = User::create([
			'name' => $request->get('name'),
			'email' => $request->get('email'),
			'password' => Hash::make($request->get('password')),
			'no_telp' => $request->get('no_telp'),
			'alamat' => $request->get('alamat')
		]);
		$user->save();

		$role = new RoleUser();
		$role->role_id = 1;
		$role->user_id = $user->id;
		$role->save();

		return response()->json([
            'message' => 'User Successfully created!'
        ], 201);
	}

	public function registKomunitas(Request $request){
		$credentials = validator($request->only('name', 'email', 'password', 'no_telp', 'alamat', 'legalitas', 'tgl_berdiri', 'foto_komunitas', 'status'), [
			'name' => 'required|string',
			'email' => 'required|string|min:6|max:50|unique:users',
			'password' => 'required|string',
			'no_telp'  => 'required|string',
			'alamat' => 'required|string',
			'legalitas' => 'required',
			'tgl_berdiri',
			'foto_komunitas'
		]);

		if ($credentials->fails()){
			return response()->json( $credentials->errors()->all(), 401 );
		}

		$user = User::create([
			'name' => $request->get('name'),
			'email' => $request->get('email'),
			'password' => Hash::make($request->get('password')),
			'no_telp' => $request->get('no_telp'),
			'alamat' => $request->get('alamat')
		]);
		$user->save();

		$komunitas = Komunitas::create([
			'legalitas' => $request->get('legalitas'),
			'tgl_berdiri' => $request->get('tgl_berdiri'),
			'foto_komunitas' => $request->get('foto_komunitas'),
			'status' => false,
			'user_id' => $user->id
		]);

		$komunitas->save();

		$role = new RoleUser;
		$role->role_id = 2;
		$role->user_id = $user->id;
		$role->save();

		return response()->json([
            'message' => 'Komunitas Successfully created!'
        ], 201);
	}

	public function registDonatur(Request $request){
		$credentials = validator($request->only('name', 'email', 'password', 'no_telp', 'jenis_kelamin', 'alamat'), [
			'name' => 'required|string',
			'email' => 'required|string|min:6|max:50|unique:users',
			'password' => 'required|string',
			'no_telp'  => 'required|string',
			'jenis_kelamin' => 'required',
			'alamat' => 'required|string',
		]);

		if ($credentials->fails()){
			return response()->json( $credentials->errors()->all(), 401 );
		}

		$user = User::create([
			'name' => $request->get('name'),
			'email' => $request->get('email'),
			'password' => Hash::make($request->get('password')),
			'no_telp' => $request->get('no_telp'),
			'alamat' => $request->get('alamat')
		]);
		$user->save();

		$donatur = Donatur::create([
			'jenis_kelamin' => $request->get('jenis_kelamin'),
			'user_id' => $user->id
		]);
		$donatur->save();

		$role = new RoleUser;
		$role->role_id = 4;
		$role->user_id = $user->id;
		$role->save();

		return response()->json([
            'message' => 'Donatur Successfully created!'
        ], 201);
	}

	public function registerRelawan(Request $request) {
		$credsrelawan = validator($request->only('name', 'email', 'password', 'no_telp', 'alamat', 'jenis_kendaraan', 'jenis_kelamin', 'foto'), [
			'name' => 'required|string',
			'email' => 'required|string|min:6|max:50|unique:users',
			'password' => 'required|string',
			'no_telp'  => 'required|string',
			'alamat' => 'required|string',
			'jenis_kendaraan'  => 'required|string',
			'jenis_kelamin' => 'required',
			'foto' => 'required'
		]);

		if ($credsrelawan->fails()){
			return response()->json( $credsrelawan->errors()->all(), 401 );
		}

		$user = User::create([
			'name' => $request->get('name'),
			'email' => $request->get('email'),
			'password' => Hash::make($request->get('password')),
			'no_telp' => $request->get('no_telp'),
			'alamat' => $request->get('alamat')
		]);
		$user->save();

		$relawan = new Relawan;
		$relawan->jenis_kendaraan = $request->get('jenis_kendaraan');
		$relawan->jenis_kelamin = $request->get('jenis_kelamin');
		$relawan->user_id = $user->id;
		$relawan->save();

		$role = new RoleUser;
		$role = new RoleUser;
		$role->role_id = 3;
		$role->user_id = $user->id;
		$role->save();


		//$relawan = Relawan::create([
		//	'jenis_kendaraan' => $request->get('jenis_kendaraan'),
		//	'jenis_kelamin' => $request->get('jenis_kelamin'),
		//	'user_id' => $user->id
		//]);
	}

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
	}
	
	

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
