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

        $data = User::join('mandira_db.pelatihan_pesertas as P', 'users.email', '=', 'P.email_peserta')
        ->select('users.*','P.*')
        ->get();

        // dd($id);
        // $blk_id = auth()->user()->blks_id_admin;

        $peserta = User::join('mandira_db.pelatihan_pesertas as P', 'users.email', '=', 'P.email_peserta')
            ->join('mandira_db.sesi_pelatihans as S', 'P.sesi_pelatihans_id', '=', 'S.id')
            ->where('sesi_pelatihans_id', $id)
            ->select('users.*','P.*')
            ->get();
        // dd($peserta);
        $lolos = User::join('mandira_db.pelatihan_pesertas as P', 'users.email', '=', 'P.email_peserta')
            ->join('mandira_db.sesi_pelatihans as S', 'P.sesi_pelatihans_id', '=', 'S.id')
            ->where('sesi_pelatihans_id', $id)
            ->where('P.rekom_keputusan', 'LULUS')
            ->select('users.*','P.*')
            ->get();

        $cadangan = User::join('mandira_db.pelatihan_pesertas as P', 'users.email', '=', 'P.email_peserta')
            ->join('mandira_db.sesi_pelatihans as S', 'P.sesi_pelatihans_id', '=', 'S.id')
            ->where('sesi_pelatihans_id', $id)
            ->where('P.rekom_keputusan', 'CADANGAN')
            ->select('users.*', 'P.*')
            ->get();

        $kompeten = User::join('mandira_db.pelatihan_pesertas as P', 'users.email', '=', 'P.email_peserta')
            ->join('mandira_db.sesi_pelatihans as S', 'P.sesi_pelatihans_id', '=', 'S.id')
            ->where('sesi_pelatihans_id', $id)
            ->where('P.hasil_kompetensi', 'KOMPETEN')
            ->select('users.*','P.*')
            ->get();

        $daftarUlang = User::join('mandira_db.pelatihan_pesertas as P', 'users.email', '=', 'P.email_peserta')
            ->join('mandira_db.sesi_pelatihans as S', 'P.sesi_pelatihans_id', '=', 'S.id')
            ->where('sesi_pelatihans_id', $id)
            ->where('P.is_daftar_ulang', '1')
            ->select('users.*','P.*')
            ->get();
        return view('pelaporan.index', compact('data', 'peserta', 'lolos', 'cadangan','kompeten','daftarUlang'));
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
