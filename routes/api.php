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

//Route::middleware('auth:api')->group( function(){
//	Route::post('/login', 'Auth\LoginController@login');
//	Route::post('/register', 'Auth\RegisterController@register');
//	Route::get('/getuser', 'Auth\UserController@user');
//	Route::post('/regiskomunitas', 'Auth\RegisterController@registKomunitas');
//	Route::post('/regisdonatur', 'Auth\RegisterController@registDonatur');
//});

Route::prefix('/user')->group( function(){
	Route::post('/login', 'Auth\LoginController@login');
	Route::post('/register', 'Auth\RegisterController@register');
	Route::get('/getuser', 'Auth\UserController@user');
	Route::post('/regiskomunitas', 'Auth\RegisterController@registKomunitas');
	Route::post('/regisdonatur', 'Auth\RegisterController@registDonatur');
});

Route::post('createdonasi', 'DonasiController@createDonasi');
Route::post('updatedonasi/{id}', 'DonasiController@updateDonasi');
Route::post('updaterelawan/{id}', 'DonasiController@findRelawan');
Route::post('updatepenerima/{id}', 'DonasiController@updatePenerimaDonasi');
Route::get('getdonasi', 'DonasiController@index');
Route::get('getuser', 'UserController@user');