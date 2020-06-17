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

Route::group(['middleware' => 'auth:api'], function () {
	Route::get('/getuser', 'UserController@user');
	Route::get('/donasikomunitas', 'DonasiController@index');
	Route::get('/donasikomunitas/{id}', 'DonasiController@showDetail');
	Route::get('/listdonasi', 'DonasiController@listDonasi');
	Route::get('/donasidonatur', 'DonaturController@index');
	Route::get('/relawankomunitas', 'KomunitasController@index');
	Route::post('updatedonasi/{id}', 'DonasiController@updateDonasi');
});

Route::post('createdonasi', 'DonasiController@createDonasi');
Route::post('updaterelawan/{id}', 'DonasiController@findRelawan');
Route::post('accrelawan/{id}', 'DonasiController@accRelawan');
Route::post('updatepenerima/{id}', 'DonasiController@updatePenerimaDonasi');
Route::get('getdonasi', 'DonasiController@index');
//Route::get('donasikomunitas', 'DonasiController@index');

//Route::prefix('/user')->group( function(){
//	Route::post('/login', 'Auth\LoginController@login');
//	Route::post('/register', 'Auth\RegisterController@register');
//	Route::get('/getuser', 'Auth\LoginController@user');
//	Route::post('/regiskomunitas', 'Auth\RegisterController@registKomunitas');
//	Route::post('/regisdonatur', 'Auth\RegisterController@registDonatur');
//});