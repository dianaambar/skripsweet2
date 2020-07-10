<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', 'Auth\LoginController@login');
Route::post('/register', 'Auth\RegisterController@register');
Route::post('/regiskomunitas', 'Auth\RegisterController@registKomunitas');
Route::post('/regisdonatur', 'Auth\RegisterController@registDonatur');
Route::post('/regisrelawan', 'Auth\RegisterController@registRelawan');

Route::get('/getmakanan', 'DonasiController@showMakanan');

Route::group(['middleware' => 'auth:api'], function () {
	Route::get('/getuser', 'UserController@user');
	Route::post('logout', 'UserController@logoutApi');

	Route::get('/donasikomunitas', 'DonasiController@index');
	Route::get('/donasikomunitas/{id}', 'DonasiController@showDetail');
	Route::get('/listdonasi', 'DonasiController@listDonasi');
	Route::get('/donasidonatur', 'DonaturController@index');
	Route::get('/historydonasi', 'DonaturController@historyDonasi');
	Route::put('/updatedonasi/{id}', 'DonasiController@updateDonasi');
	Route::post('/createdonasi', 'DonasiController@createDonasi');
	Route::post('/selectrelawan/{id}', 'DonasiController@findRelawan');
	Route::post('/accrelawan/{id}', 'DonasiController@accRelawan');
	//Route::post('/accrelawan', 'DonasiController@accRelawan');
	Route::get('/donasiselesai', 'DonasiController@donasiSelesai');
	Route::get('/donasi', 'DonasiController@allDonasi');
	Route::post('/updatenonrelawan/{id}', 'DonasiController@updatePenerimaDonasiNonRelawan');

	Route::get('/history', 'KomunitasController@allTransactions');
	Route::get('/relawankomunitas', 'KomunitasController@getRelawan');
	Route::get('/datakomunitas', 'KomunitasController@dataKomunitas');
	Route::post('/acceptrelawan/{id}', 'KomunitasController@accRelawan');
	Route::get('/nonacckomunitas', 'KomunitasController@nonAccKomunitas');
	Route::get('/closestrelawan/{latitude}/{longitude}', 'KomunitasController@closestRelawan');
	Route::get('/jumlahdata', 'KomunitasController@jmlTransaksi');
	Route::post('/disablerelawan/{id}', 'KomunitasController@disableRelawan');
	Route::post('/ignorerelawan/{id}', 'KomunitasController@ignoreRelawan');

	Route::get('/donatur', 'DonaturController@allDonatur');
	Route::get('/donasidonatur', 'DonaturController@index');

	Route::post('/acckomunitas/{id}', 'AdminController@accKomunitas');

	Route::get('/komunitas', 'KomunitasController@showKomunitas');
	Route::get('/nonaccrelawan', 'RelawanController@index');
	Route::get('/relawan', 'RelawanController@allRelawan');
	Route::get('/donasirelawan', 'RelawanController@donasiRelawan');
	Route::post('/locrelawan/{id}', 'RelawanController@updateLatLong');
	Route::get('/accbyrelawan', 'RelawanController@acceptByRelawan');
	Route::get('/detailrelawan/{id}', 'RelawanController@showDataRelawan');
});


// Route::get('/komunitas', 'KomunitasController@showKomunitas');

Route::post('/updatepenerima', 'DonasiController@updatePenerimaDonasi');
//Route::post('createdonasi', 'DonasiController@createDonasi');
//Route::post('updaterelawan/{id}', 'DonasiController@findRelawan');
//Route::post('accrelawan/{id}', 'DonasiController@accRelawan');
//Route::post('updatepenerima/{id}', 'DonasiController@updatePenerimaDonasi');
//Route::get('getdonasi', 'DonasiController@index');
//k::get('donasikomunitas', 'DonasiController@index');

//Route::prefix('/user')->group( function(){
//	Route::post('/login', 'Auth\LoginController@login');
//	Route::post('/register', 'Auth\RegisterController@register');
//	Route::get('/getuser', 'Auth\LoginController@user');
//	Route::post('/regiskomunitas', 'Auth\RegisterController@registKomunitas');
//	Route::post('/regisdonatur', 'Auth\RegisterController@registDonatur');
//});