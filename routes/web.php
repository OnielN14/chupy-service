<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




Auth::routes();
Route::middleware('auth')->group(function(){
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('/map','MapController@index')->name('map');
    Route::get('/map/getMap','MapController@getMap')->name('getMap');

    Route::get('/pengguna','PenggunaController@index')->name('pengguna');
    Route::get('/pengguna/getPengguna','PenggunaController@getPengguna')->name('getPengguna');
    Route::post('/pengguna/addPengguna','PenggunaController@addPengguna')->name('addPengguna');
    Route::delete('/pengguna/deletePengguna/{id}','PenggunaController@deletePengguna')->name('deletePengguna');
});


Route::get('/',function(){
    return view('landingpage');
});


// Route::resource('penggunas', 'PenggunaController');
// Route::resource('produks', 'ProdukController');
// Route::resource('kontens', 'KontenController');
// Route::resource('petshops', 'PetshopController');
// Route::resource('tagKontens', 'TagKontenController');
// Route::resource('kategoriKontens', 'KategoriKontenController');