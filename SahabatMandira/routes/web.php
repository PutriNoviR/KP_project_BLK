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

// SuperAdmin
Route::middleware('super.admin')->group(function(){
    //Kejuruan
    Route::resource('menu/kejuruans','Pelatihan\KejuruanController');
    Route::post('menu/kejuruans/getEditForm','Pelatihan\KejuruanController@getEditForm')->name('kejuruans.getEditForm');

    //BLK
    Route::resource('menu/blk','Pelatihan\BlkController');
    Route::post('menu/blk/getEditForm','Pelatihan\BlkController@getEditForm')->name('blk.getEditForm');

    //SubKejuruan
    Route::resource('menu/subkejuruan','Pelatihan\SubkejuruanController');
    Route::post('menu/subkejuruan/getEditForm','Pelatihan\SubkejuruanController@getEditForm')->name('subkejuruan.getEditForm');
    Route::post('menu/subkejuruan/getDetail','Pelatihan\SubkejuruanController@getDetail')->name('subkejuruan.getDetail');
     // Data Pegawai
    Route::get('datapegawai/adminblk','UserController@daftarAdminBlk')->name('super.adminblk');
    Route::post('datapegawai/adminblk/tambah','UserController@tambahAdminBlk')->name('super.adminblk.store');
    Route::post('datapegawai/adminblk/hapus','UserController@daftarAdminBlk')->name('super.adminblk.destroy');
    Route::put('datapegawai/adminblk/edit','UserController@editAdminBlk')->name('super.adminblk.update');
    Route::post('datapegawai/adminblk/getEditForm','UserController@getEditFormAdminBlk')->name('super.adminblk.getEditForm');
});


//Peserta
Route::resource('menu/peserta','PesertaController');
Route::post('menu/peserta/edit', 'PesertaController@getEditForm')->name('peserta.edit');
Route::post('/kelengkapan data diri', 'PesertaController@kelengkapanDataPribadi')->name('pengguna.data.pribadi');
Route::post('/kelengkapan dokumen', 'PesertaController@kelengkapanDataDokumen')->name('pengguna.data.dokumen');

//CRUD
Route::resource('soal', "PertanyaanController");
Route::post('menu/admin/getEditForm', 'PertanyaanController@getEditForm')->name('soal.edit');

//REPORT
Route::get('menu/detailPelatihan','Pelatihan\KejuruanController@detailAllPelatihan');


//Perusahaan
Route::resource('menu/perusahaan','Bursa\PerusahaanController');


//Paket Program
Route::view('/paketProgram','paketprogram.index');
//Sesi Pelatihan


Route::get('/helloworld', function () {
    return view('layouts.adminlte');
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
