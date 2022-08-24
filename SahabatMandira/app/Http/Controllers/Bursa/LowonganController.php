<?php

namespace App\Http\Controllers\Bursa;

use App\Http\Controllers\Controller;
use App\Lowongan;
use Illuminate\Http\Request;

class LowonganController extends Controller
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
        return view ("lowongan.create");
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
        $lowongan = new Lowongan();
        $lowongan->nama=$request->nama;
        $lowongan->pengalaman_kerja=$request->pengalaman_kerja;
        $lowongan->lokasi_kerja=$request->lokasi_kerja;
        $lowongan->gaji=$request->gaji;
        $lowongan->pendidikan_terakhir=$request->nama;
        $lowongan->jam_kerja=$request->jam_kerja;
        $lowongan->deskripsi_kerja=$request->deskripsi_kerja;
        $lowongan->profile_perusahaan=$request->profile_perusahaan;
        $lowongan->save();
        return redirect()->back()->with('success', 'Data lowongan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Lowongan  $lowongan
     * @return \Illuminate\Http\Response
     */
    public function show(Lowongan $lowongan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Lowongan  $lowongan
     * @return \Illuminate\Http\Response
     */
    public function edit(Lowongan $lowongan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Lowongan  $lowongan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lowongan $lowongan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lowongan  $lowongan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lowongan $lowongan)
    {
        //
    }
}
