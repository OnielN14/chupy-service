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
    Route::get('/', 'DashboardController@index')->name('dashboard');
    Route::get('/map','MapController@index')->name('map');
    Route::get('/map/getMap','MapController@getMap')->name('map.getMap');
});





// Route::resource('penggunas', 'PenggunaController');
// Route::resource('produks', 'ProdukController');