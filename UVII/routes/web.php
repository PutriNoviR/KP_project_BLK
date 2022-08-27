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

// Route::get('/', function () {
//     return view('welcome');
// })

Route::get('/', 'HomeController@index')->middleware('auth')->name('home');

// Role
Route::resource('menu/role','RoleController');
Route::post('menu/role/edit', 'RoleController@getEditForm')->name('role.edit');
Route::resource('manajemen', "MenuManajemenController");
Route::post('manajemen/edit', "MenuManajemenController@getEditForm")->name('menu.edit');
Route::post('manajemen/role/save', "MenuManajemenController@menuRole")->name('manajemen.role');
Route::post('manajemen/getDataMenu', 'MenuManajemenController@getDataMenu')->name('menu.getDataMenu');

//Peserta
Route::resource('menu/peserta','PesertaController');
Route::post('menu/peserta/edit', 'PesertaController@getEditForm')->name('peserta.edit');
Route::post('/kelengkapan data diri', 'PesertaController@kelengkapanDataPribadi')->name('peserta.data.pribadi');
Route::post('/kelengkapan dokumen', 'PesertaController@kelengkapanDataDokumen')->name('peserta.data.dokumen');


//Tes Tahap Awal
Route::get('menu/tes', 'TesTahapAwalController@menuTesHome')->name('peserta.tes');
Route::get('menu/tes/uji-tahap-awal', 'TesTahapAwalController@menuTesUjiTahapAwal')->name('peserta.uji.tahap.awal');
Route::get('menu/tes/uji', 'TesTahapAwalController@test');
Route::post('menu/tes/uji-tahap-awal/save', 'TesTahapAwalController@simpanJawaban')->name('peserta.save.jawaban');
Route::post('menu/tes/timer', 'TesTahapAwalController@updateTimer')->name('peserta.update.timer');
Route::post('soal_hasil/score','TesTahapAwalController@hasilTes')->name('soal.tambahan.score');

//CRUD
Route::resource('menu/blk', 'BlkController');
Route::resource('soal', "PertanyaanController");
Route::post('menu/admin/getEditForm', 'PertanyaanController@getEditForm')->name('soal.edit');
Route::get('soal_setting','PertanyaanController@setting')->name('soal.setting');
Route::post('soal_setting/save','PertanyaanController@getSetting')->name('soal.setting.save');
Route::get('soal_hasil/score','TesTahapAwalController@hasilTes')->name('soal.hasilJawaban.score');

//riwayat tes
Route::get('riwayat/tes/peserta', 'TesTahapAwalController@riwayatTes')->name('riwayat_tes.user');
Route::get('riwayat/tes_global/peserta', 'TesTahapAwalController@riwayatTesGlobal')->name('riwayat_tes_global.user');

//import
Route::get('importView','ImportController@importView');
Route::post('import','ImportController@import')->name('import');


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



