<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
})->middleware('auth');

// Role
Route::resource('menu/role','RoleController');
Route::post('menu/role/edit', 'RoleController@getEditForm')->name('role.edit');

//Peserta
Route::resource('menu/peserta','PesertaController');
Route::post('menu/peserta/edit', 'PesertaController@getEditForm')->name('peserta.edit');

//CRUD
Route::resource('menu/blk', 'BlkController');
Route::resource('soal', "PertanyaanController");
Route::post('menu/admin/getEditForm', 'PertanyaanController@getEditForm')->name('soal.edit');
// Route::get('/home', 'HomeController@dashboardPage')->name('home');

Route::get('/helloworld', function () {
    return 'Hello World, Pak Dosen';
});

Route::view('/selamatdatang','welcome');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['can:admin-permission'])->group(function(){
    // Route::get('/add-to-cart/{id}', 'ObatController@addToCart');
    // Route::get('/delete-item-cart/{id}', 'ObatController@deleteItemCart');
    // Route::get('/cart', 'ObatController@cart');
    // Route::resource('/transaksi', TransaksiController::class);
    // Route::get('/checkout', 'TransaksiController@form_submit_front');
    // Route::get('/submit_checkout', 'TransaksiController@submit_front')->name('submitcheckout');

});



