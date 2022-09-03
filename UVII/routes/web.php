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
Route::post('/forgotPassword', 'PesertaController@forgotPasswords')->name('password.updates');

Route::get('/forgotPassword', 'PesertaController@getForgotPasswords')->name('password.baru');

Route::get('/', 'HomeController@index')->middleware('auth')->name('home');

Route::get('/helloworld', function () {
    return 'Hello World, Pak Dosen';
});

Route::view('/selamatdatang','welcome');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['can:admin-permission'])->group(function(){
    //riwayat tes
    Route::get('riwayat/tes_global/peserta', 'TesTahapAwalController@riwayatTesGlobal')->name('riwayat_tes_global.user');

    //import
    Route::get('importView','ImportController@importView');
    Route::post('import','ImportController@import')->name('import');

    //CRUD
    Route::resource('menu/blk', 'BlkController');
    Route::resource('soal', "PertanyaanController");
    Route::post('menu/admin/getEditForm', 'PertanyaanController@getEditForm')->name('soal.edit');
    Route::get('soal_setting','PertanyaanController@setting')->name('soal.setting');
    Route::post('soal_setting/save','PertanyaanController@getSetting')->name('soal.setting.save');

    //Peserta
    Route::resource('menu/peserta','PesertaController');
    Route::post('menu/peserta/edit', 'PesertaController@getEditForm')->name('peserta.edit');

    // Role
    Route::resource('menu/role','RoleController');
    Route::post('menu/role/edit', 'RoleController@getEditForm')->name('role.edit');
    Route::resource('manajemen', "MenuManajemenController");
    Route::post('manajemen/edit', "MenuManajemenController@getEditForm")->name('menu.edit');
    Route::post('manajemen/role/save', "MenuManajemenController@menuRole")->name('manajemen.role');
    Route::post('manajemen/getDataMenu', 'MenuManajemenController@getDataMenu')->name('menu.getDataMenu');

    //Soal Aktif
    Route::post('aktif','PertanyaanController@updateEnable')->name('update.enable');
});

Route::middleware(['can:peserta-permission'])->group(function(){
    //CRUD
    Route::get('soal_hasil/score','TesTahapAwalController@hasilTes')->name('soal.hasilJawaban.score');

    // riwayat tes
    Route::get('riwayat/tes/peserta', 'TesTahapAwalController@riwayatTes')->name('riwayat_tes.user');

    //Tes Tahap Awal
    Route::get('menu/tes', 'TesTahapAwalController@menuTesHome')->name('peserta.tes');
    Route::get('menu/tes/uji-tahap-awal', 'TesTahapAwalController@menuTesUjiTahapAwal')->name('peserta.uji.tahap.awal');
    Route::get('menu/tes/uji', 'TesTahapAwalController@test');
    Route::post('menu/tes/uji-tahap-awal/save', 'TesTahapAwalController@simpanJawaban')->name('peserta.save.jawaban');
    Route::post('menu/tes/timer', 'TesTahapAwalController@updateTimer')->name('peserta.update.timer');
    Route::post('soal_hasil/score','TesTahapAwalController@hasilTes')->name('soal.tambahan.score');

    //Peserta
    Route::resource('menu/peserta','PesertaController');
    Route::post('menu/peserta/edit', 'PesertaController@getEditForm')->name('peserta.edit');
    Route::post('/kelengkapan data diri', 'PesertaController@kelengkapanDataPribadi')->name('peserta.data.pribadi');
    Route::post('/kelengkapan dokumen', 'PesertaController@kelengkapanDataDokumen')->name('peserta.data.dokumen');

    //halaman camera
    Route::get('menu/tes/camera', 'CameraController@camera')->name('peserta.camera');
    Route::post('/capture', 'CameraController@capture')->name('capture');
    Route::post('/capture/akhir', 'CameraController@captureAkhir')->name('capture.akhir');
    Route::get('/validate', 'CameraController@adminValidate')->name('admin.validate');


});



