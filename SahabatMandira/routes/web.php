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

Route::get('register/mentor', 'Auth\RegisterController@regisMentor')->name('registerMentor');

Route::post('testingDir/create', 'EncryptController@encrypt_user_data');
// TESTING SECTION ENDS HERE

Route::get('/', 'HomeController@index')->name('home');
Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');

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
    Route::delete('datapegawai/adminblk/hapus/{email}','UserController@hapusAdminBlk')->name('super.adminblk.destroy');
    Route::put('datapegawai/adminblk/edit','UserController@editAdminBlk')->name('super.adminblk.update');
    Route::post('datapegawai/adminblk/getEditForm','UserController@getEditFormAdminBlk')->name('super.adminblk.getEditForm');
});

// Dashboard


//Peserta
Route::resource('menu/peserta','PesertaController');
Route::post('menu/peserta/edit', 'PesertaController@getEditForm')->name('peserta.edit');
Route::post('/kelengkapan data diri', 'PesertaController@kelengkapanDataPribadi')->name('pengguna.data.pribadi');
Route::post('/kelengkapandokumen/', 'PesertaController@kelengkapanDataDokumen')->name('pengguna.data.dokumen');

//CRUD
Route::resource('soal', "PertanyaanController");
Route::post('menu/admin/getEditForm', 'PertanyaanController@getEditForm')->name('soal.edit');

//REPORT
Route::get('menu/detailPelatihan','Pelatihan\KejuruanController@detailAllPelatihan');

//Perusahaan
Route::resource('menu/perusahaan','Bursa\PerusahaanController');
Route::get('profile/perusahaan','Bursa\PerusahaanController@profile')->name('perusahaan.profile');

//Lowongan
Route::resource('menu/lowongan','Bursa\LowonganController');
Route::post('menu/lowongan/getEdit','Bursa\LowonganController@getEdit')->name('lowongan.getEdit');
Route::get('semua-lowongan','Bursa\LowonganController@semuaLowongan')->name('lowongan.semua');

//List Kerja
Route::resource('bursa/listKerja','Bursa\ListKerjaController');

//Lamaran
Route::resource('lamaran','LamaranController');
Route::post('lamaran/getEditForm','LamaranController@getEditForm')->name('lamaran.getEditForm');
Route::get('/kegiatanku/lamaran','LamaranController@index')->name('lamaran.lamaranku');

//Paket Program
Route::resource('paketProgram','PaketProgramPelatihanController');
Route::post('paketProgram/getEditForm','PaketProgramPelatihanController@getEditForm')->name('paketProgram.getEditForm');
route::post('paketProgram/getSubKejuruan','PaketProgramPelatihanController@getSubkejuruan')->name('paketProgram.getSubKejuruan');

//Sesi Pelatihan
Route::resource('/sesiPelatihan','SesiPelatihanController');
Route::post('sesiPelatihan/getDetail','SesiPelatihanController@getDetailPeserta')->name('sesiPelatihan.getDetailPeserta');
Route::get('sesiPelatihan/{id}','SesiPelatihanController@show')->name('sesiPelatihan.detail');
Route::get('sesiPelatihan/riwayat','SesiPelatihanController@riwayatPelatihan')->name('sesiPelatihan.peserta');
Route::get('sesiPelatihan/showMore/{id}','SesiPelatihanController@showMore')->name('sesiPelatihan.showMore');
Route::get('daftarPelatihan','SesiPelatihanController@daftarPelatihan')->name('sesiPelatihan.daftarPelatihan');
Route::post('daftarPelatihan/daftarulang','SesiPelatihanController@daftarUlang')->name('sesiPelatihan.daftarulang');

//Tugas
Route::resource('/tugas','TugasController');

//User
Route::resource('User','UserController');
Route::post('User/getEditForm','UserController@getEditForm')->name('user.getEditForm');
Route::post('User/{id}','UserController@update')->name('User.update');
Route::get('User/peserta','UserController@daftarPeserta')->name('User.peserta');

Route::get('/helloworld', function () {
    return view('layouts.adminlte');
});

//PelatihanMentors
Route::resource('/pelatihanMentors','PelatihanMentorController');

//PelatihanPeserta
Route::resource('/pelatihanPesertas','PelatihanPesertaController');
Route::get('pelatihanPeserta/lengkapiBerkas/{idpelatihan}','PelatihanPesertaController@lengkapiBerkas')->name('pelatihanPeserta.lengkapiBerkas');
Route::get('pelatihanPeserta/pendaftaran','PelatihanPesertaController@pendaftaran')->name('pelatihanPeserta.pendaftaran');
Route::get('pelatihanPeserta/{id}','PelatihanPesertaController@show')->name('pelatihanPeserta.detail');
Route::post('pelatihanPeserta/getEditForm','PelatihanPesertaController@getEditForm')->name('pelatihanPesertas.getEditForm');
Route::post('pelatihanPeserta/getKompetensiForm','PelatihanPesertaController@getKompetensiForm')->name('pelatihanPesertas.getKompetensiForm');
Route::put('pelatihanPeserta/{email}','PelatihanPesertaController@update')->name('pelatihanPesertas.update');
Route::put('pelatihanPeserta/{email}','PelatihanPesertaController@updateKompetensi')->name('pelatihanPesertas.updateKompetensi');
Route::post('pelatihanPeserta/pendaftaran/{id}','PelatihanPesertaController@storePendaftar')->name('pelatihanPesertas.storePendaftar');
Route::get('/pelatihanPeserta/jadwalSeleksi','PelatihanPesertaController@urutan')->name('pelatihanpeserta.jadwal');

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
