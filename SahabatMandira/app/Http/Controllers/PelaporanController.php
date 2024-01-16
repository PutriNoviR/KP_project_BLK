<?php

namespace App\Http\Controllers;

use App\Pelaporan;
use App\PelatihanPeserta;
use Illuminate\Http\Request;
use App\User;
use App\SesiPelatihan;
use Auth;
use DB;

class PelaporanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pelaporan  $pelaporan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

        //Mengambil semua data user
        $data = User::join('mandira_db.pelatihan_pesertas as P', 'users.email', '=', 'P.email_peserta')
        ->select('users.*','P.*')
        ->get();

        // dd($id);
        // $blk_id = auth()->user()->blks_id_admin;

        //ambil data peserta pada sesi pelatihan
        $peserta = User::join('mandira_db.pelatihan_pesertas as P', 'users.email', '=', 'P.email_peserta')
            ->join('mandira_db.sesi_pelatihans as S', 'P.sesi_pelatihans_id', '=', 'S.id')
            ->where('sesi_pelatihans_id', $id)
            ->select('users.*','P.*','S.tanggal_mulai_pelatihan','S.tanggal_seleksi')
            ->get();
        // dd($peserta);

        //ambil data peserta yang lolos sesi pelatihan
        $lolos = User::join('mandira_db.pelatihan_pesertas as P', 'users.email', '=', 'P.email_peserta')
            ->join('mandira_db.sesi_pelatihans as S', 'P.sesi_pelatihans_id', '=', 'S.id')
            ->where('sesi_pelatihans_id', $id)
            ->where('P.rekom_keputusan', 'LULUS')
            ->select('users.*','P.*','S.tanggal_mulai_pelatihan')
            ->get();

        //ambil data peserta yang merupakan peserta cadangan pada sesi pelatihan
        $cadangan = User::join('mandira_db.pelatihan_pesertas as P', 'users.email', '=', 'P.email_peserta')
            ->join('mandira_db.sesi_pelatihans as S', 'P.sesi_pelatihans_id', '=', 'S.id')
            ->where('sesi_pelatihans_id', $id)
            ->where('P.rekom_keputusan', 'CADANGAN')
            ->select('users.*', 'P.*','S.tanggal_mulai_pelatihan')
            ->get();

        //ambil data peserta yang kompeten pada sesi pelatihan
        $kompeten = User::join('mandira_db.pelatihan_pesertas as P', 'users.email', '=', 'P.email_peserta')
            ->join('mandira_db.sesi_pelatihans as S', 'P.sesi_pelatihans_id', '=', 'S.id')
            ->where('sesi_pelatihans_id', $id)
            ->where('P.hasil_kompetensi', 'KOMPETEN')
            ->select('users.*','P.*','S.tanggal_mulai_pelatihan')
            ->get();

        //ambil data peserta yang sudah daftar ulang 
        $daftarUlang = User::join('mandira_db.pelatihan_pesertas as P', 'users.email', '=', 'P.email_peserta')
            ->join('mandira_db.sesi_pelatihans as S', 'P.sesi_pelatihans_id', '=', 'S.id')
            ->where('sesi_pelatihans_id', $id)
            ->where('P.is_daftar_ulang', '1')
            ->select('users.*','P.*','S.tanggal_mulai_pelatihan')
            ->get();

        // ambil data peserta yang mendaftar di pelatihan dan mengikuti seleksi
        $mengikutiSeleksi = User::join('mandira_db.pelatihan_pesertas as P', 'users.email', '=', 'P.email_peserta')
            ->join('mandira_db.sesi_pelatihans as S', 'P.sesi_pelatihans_id', '=', 'S.id')
            ->where('sesi_pelatihans_id', $id)
            ->whereNotNull('P.rekom_keputusan')
            ->select('users.*','P.*','S.tanggal_mulai_pelatihan')
            ->get();

        
        return view('pelaporan.index', compact('data', 'peserta', 'lolos', 'cadangan','kompeten','daftarUlang','mengikutiSeleksi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pelaporan  $pelaporan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pelaporan $pelaporan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pelaporan  $pelaporan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pelaporan $pelaporan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pelaporan  $pelaporan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pelaporan $pelaporan)
    {
        //
    }
}
