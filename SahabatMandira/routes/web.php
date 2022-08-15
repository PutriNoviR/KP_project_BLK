<?php

use Illuminate\Support\Facades\Auth;
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

// Route::get('/', function () {
//     return view('welcome');
// })

// FOR TESTING PURPOSE ONLY - TESTING SECTION STARTS
Route::get('/testingDir', function () {
        return view('dummy-testing.dummy');
    });

Route::post('testingDir/create', 'EncryptController@encrypt_user_data');
// TESTING SECTION ENDS HERE

Route::get('/', 'HomeController@index')->middleware('auth')->name('home');

// Role
Route::resource('menu/role','RoleController');
Route::post('menu/role/edit', 'RoleController@getEditForm')->name('role.edit');

//Peserta
Route::resource('menu/peserta','PesertaController');
Route::post('menu/peserta/edit', 'PesertaController@getEditForm')->name('peserta.edit');
Route::post('/kelengkapan data diri', 'PesertaController@kelengkapanDataPribadi')->name('pengguna.data.pribadi');
Route::post('/kelengkapan dokumen', 'PesertaController@kelengkapanDataDokumen')->name('pengguna.data.dokumen');

//CRUD
Route::resource('soal', "PertanyaanController");
Route::post('menu/admin/getEditForm', 'PertanyaanController@getEditForm')->name('soal.edit');

//REPORT
Route::resource('menu/kejuruans','Pelatihan\KejuruanController');
Route::resource('menu/blk','Pelatihan\BlkController');
Route::resource('menu/subkejuruan','Pelatihan\SubkejuruanController');
Route::get('menu/detailPelatihan','Pelatihan\KejuruanController@detailAllPelatihan');

//Kejuruan
Route::get('menu/kejuruans/detail/{id}','Pelatihan\KejuruanController@detail');
Route::get('menu/kejuruans/update','Pelatihan\KejuruanController@update');
Route::get('menu/kejuruans/delete','Pelatihan\KejuruanController@delete');
Route::get('menu/kejuruans/create','Pelatihan\KejuruanController@create');

//BLK
Route::get('menu/blk/detail/{id}','Pelatihan\BlkController@detail');
Route::get('menu/blk/update','Pelatihan\BlkController@update');
Route::get('menu/blk/delete','Pelatihan\BlkController@delete');
Route::get('menu/blk/create','Pelatihan\BlkController@create');

//SubKejuruan
Route::get('menu/subkejuruan/detail/{id}','Pelatihan\SubkejuruanController@detail');
Route::get('menu/subkejuruan/update','Pelatihan\SubkejuruanController@update');
Route::get('menu/subkejuruan/delete','Pelatihan\SubkejuruanController@delete');
Route::get('menu/subkejuruan/create','Pelatihan\SubkejuruanController@create');

//Perusahaan
Route::resource('menu/perusahaan','Bursa\PerusahaanController');

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
