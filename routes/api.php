<?php

use Illuminate\Http\Request;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::resource('maps', 'MapAPIController');

Route::resource('penggunas', 'PenggunaAPIController');
Route::post('/register','PenggunaAPIController@store')->name('register');
Route::post('/login','PenggunaAPIController@login')->name('login');

Route::resource('produks', 'ProdukAPIController');

Route::resource('kontens', 'KontenAPIController');

Route::resource('petshops', 'PetshopAPIController');

Route::resource('tagKontens', 'TagKontenAPIController');

Route::resource('kategoriKontens', 'KategoriKontenAPIController');