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

Route::middleware(['can:admin-permission','auth'])->group(function(){
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

    //admin baru
    Route::get('menu/admin', 'RoleController@showAdmin')->name('admin.show');
    Route::post('admin/tambah','RoleController@tambahAdmin')->name('admin.tambah');
    Route::post('admin/edit', 'RoleController@getEditAdmin')->name('admin.edit');
    Route::post('admin/update', 'RoleController@updateAdmin')->name('admin.update');
    Route::post('admin/delete', 'RoleController@deleteAdmin')->name('admin.delete');

    //Soal Aktif
    Route::post('aktif','PertanyaanController@updateEnable')->name('update.enable');

    //tambah klaster
    Route::resource('menu/klaster','KlasterController');
    Route::post('menu/klaster/edit', 'KlasterController@getEditForm')->name('klaster.edit');

     //tambah kategori
     Route::resource('menu/kategori','KategoriController');
     Route::post('menu/kategori/edit', 'KategoriController@getEditForm')->name('kategori.edit');

    //halaman validate
    Route::post('/validatePeserta', 'CameraController@validatePeserta')->name('validatePeserta');
    Route::post('/validate/setting', 'CameraController@validateSetting')->name('validateSetting');
    Route::get('/validate', 'CameraController@adminValidate')->name('admin.validate');


});

Route::middleware(['can:peserta-permission', 'auth'])->group(function(){
    //CRUD
    Route::get('soal_hasil/score','TesTahapAwalController@hasilTes')->name('soal.hasilJawaban.score');
    Route::get('soal_hasil/detail','TesTahapAwalController@detailJawaban')->name('soal.detail.jawaban');

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
    Route::post('/kelengkapan data diri', 'PesertaController@kelengkapanDataPribadi')->name('peserta.data.pribadi');
    Route::post('/kelengkapan dokumen', 'PesertaController@kelengkapanDataDokumen')->name('peserta.data.dokumen');
    Route::get('/profile', 'PesertaController@getProfile')->name('profile');
    Route::post('/profile/update', 'PesertaController@update')->name('profile.update');

    Route::get('tes_tahap2/hasil','TesTahapAkhirController@hasilTes2')->name('tes2.hasil');

    //halaman camera
    Route::get('menu/tes/camera', 'CameraController@camera')->name('peserta.camera');
    Route::post('/capture', 'CameraController@capture')->name('capture');
    Route::post('/capture/akhir', 'CameraController@captureAkhir')->name('capture.akhir');

});



