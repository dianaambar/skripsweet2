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
use Intervention\Image\Facades\Image as Image;

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

	public function register(Request $request)
	{
		$credentials = validator($request->only('name', 'email', 'password', 'no_telp', 'alamat'), [
			'name' => 'required|string',
			'email' => 'required|string|min:6|max:50|unique:users',
			'password' => 'required|string',
			'no_telp'  => 'required|string',
			'alamat' => 'required|string',
		]);

		if ($credentials->fails()) {
			return response()->json($credentials->errors()->all(), 401);
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

	public function registKomunitas(Request $request)
	{
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

		if ($credentials->fails()) {
			return response()->json($credentials->errors()->all(), 401);
		}
		$user = new User;
		$user->name = $request->get('name');
		$user->email = $request->get('email');
		$user->password = Hash::make($request->get('password'));
		$user->no_telp = $request->get('no_telp');
		$user->alamat = $request->get('alamat');

		//$user = User::create([
		//	'name' => $request->get('name'),
		//	'email' => $request->get('email'),
		//	'password' => Hash::make($request->get('password')),
		//	'no_telp' => $request->get('no_telp'),
		//	'alamat' => $request->get('alamat')
		//]);
		$user->save();


		$komunitas = new Komunitas;
		$komunitas->legalitas = $request->get('legalitas');
		$komunitas->tgl_berdiri = $request->get('tgl_berdiri');
		if ($request->hasFile('foto_komunitas')) {

			//$imagePath = storage_path() . '/app/public/';
			$image = $request->file('foto_komunitas');
			$imageName = str_random(8) . '.' . $image->getClientOriginalExtension();
			$image->move('images', $imageName);
			$imagePath = 'http://localhost:8000/images' . '/' . $imageName;

			$komunitas->foto_komunitas = $imagePath;
			//Image::make($image)->save($imagePath . $imageName);


			//$image = $upload_path . $saveFoto;
			//$success = $foto->move($upload_path, $saveFoto);
			//$komunitas->foto_komunitas = $image;
		}
		//$komunitas->foto_komunitas = $request->get('foto_komunitas');
		$komunitas->status = false;



		$komunitas->user_id = $user->id;

		//$komunitas = Komunitas::create([
		//	'legalitas' => $request->get('legalitas'),
		//	'tgl_berdiri' => $request->get('tgl_berdiri'),
		//	'foto_komunitas' => $request->get('foto_komunitas'),
		//	'status' => false,
		//	'user_id' => $user->id
		//]);

		$komunitas->save();

		$role = new RoleUser;
		$role->role_id = 2;
		$role->user_id = $user->id;
		$role->save();

		return response()->json([
			'message' => 'Komunitas Successfully created!',
			'user' => $user,
			'komunitas' => $komunitas
		], 201);
	}

	public function registDonatur(Request $request)
	{
		$credentials = validator($request->only('name', 'email', 'password', 'no_telp', 'jenis_kelamin', 'alamat'), [
			'name' => 'required|string',
			'email' => 'required|string|min:6|max:50|unique:users',
			'password' => 'required|string',
			'no_telp'  => 'required|string',
			'jenis_kelamin' => 'required',
			'alamat' => 'required|string',
		]);

		if ($credentials->fails()) {
			return response()->json($credentials->errors()->all(), 401);
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

	public function registRelawan(Request $request)
	{
		$credsrelawan = validator($request->only(
			'name',
			'email',
			'password',
			'no_telp',
			'alamat',
			'nama_panggilan',
			'jenis_kelamin',
			'foto_relawan',
			'agama',
			'gol_darah',
			'kabupaten_kota',
			'provinsi',
			'tempat_lahir',
			'tgl_lahir',
			'pekerjaan',
			'pend_terakhir',
			'organisasi_ongoing',
			'jenis_sim',
			'motivasi'
		), [
			'name' => 'required|string',
			'email' => 'required|string|min:6|max:50|unique:users',
			'password' => 'required|string',
			'no_telp'  => 'required|string',
			'alamat' => 'required|string',
			'nama_panggilan' => 'required',
			'jenis_kelamin' => 'required',
			'agama' => 'required',
			'gol_darah' => 'required',
			'kabupaten_kota' => 'required',
			'provinsi' => 'required',
			'tempat_lahir' => 'required',
			'tgl_lahir' => 'required',
			'pekerjaan' => 'required',
			'pend_terakhir' => 'required',
			'organisasi_ongoing' => 'required',
			'jenis_sim' => 'required',
			'motivasi' => 'required',
			'foto_relawan' => 'required|string',
			'latitude',
			'longitude'
		]);

		if ($credsrelawan->fails()) {
			return response()->json($credsrelawan->errors()->all(), 401);
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
		$relawan->komunitas_id = $request->komunitas_id;
		//$relawan->jenis_kendaraan = $request->get('jenis_kendaraan');
		$relawan->nama_panggilan = $request->get('nama_panggilan');
		$relawan->jenis_kelamin = $request->get('jenis_kelamin');
		$relawan->agama = $request->get('agama');
		$relawan->gol_darah = $request->get('gol_darah');
		$relawan->kabupaten_kota = $request->get('kabupaten_kota');
		$relawan->provinsi = $request->get('provinsi');
		$relawan->tempat_lahir = $request->get('tempat_lahir');
		$relawan->tgl_lahir = $request->get('tgl_lahir');
		$relawan->pekerjaan = $request->get('pekerjaan');
		$relawan->pend_terakhir = $request->get('pend_terakhir');
		$relawan->organisasi_ongoing = $request->get('organisasi_ongoing');
		$relawan->jenis_sim = $request->get('jenis_sim');
		$relawan->motivasi = $request->get('motivasi');
		$relawan->foto_relawan = $request->get('foto_relawan');
		$relawan->latitude = $request->get('latitude');
		$relawan->longitude = $request->get('longitude');
		$relawan->user_id = $user->id;

		$relawan->save();

		$role = new RoleUser;
		$role = new RoleUser;
		$role->role_id = 3;
		$role->user_id = $user->id;
		$role->save();

		return response()->json([
			'relawan' => $relawan
		]);

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
