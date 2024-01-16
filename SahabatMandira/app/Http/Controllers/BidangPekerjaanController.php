<?php

namespace App\Http\Controllers;

use App\bidang_kerja;
use Illuminate\Http\Request;

class BidangPekerjaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = bidang_kerja::all();
        return view('perusahaan.bidangKerja', compact('data'));
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
        $bidang = new bidang_kerja();
        $bidang->nama_bidang = $request->nama;
        $bidang->keterangan = $request->keterangan;
        $bidang->save();

        return redirect()->back()->with('success','Bidang Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\bidang_kerja  $bidang_kerja
     * @return \Illuminate\Http\Response
     */
    public function show(bidang_kerja $bidang_kerja)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\bidang_kerja  $bidang_kerja
     * @return \Illuminate\Http\Response
     */
    public function edit(bidang_kerja $bidang_kerja)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\bidang_kerja  $bidang_kerja
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        // dd($request);
        $bidang_kerja = bidang_kerja::find($id);
        $bidang_kerja->nama_bidang = $request->editNamaBidang;
        $bidang_kerja->keterangan = $request->editKeterangan;
        $bidang_kerja->save();

        return redirect()->back()->with('success','Bidang '. $request->editNamaBidang.' Berhasil Diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\bidang_kerja  $bidang_kerja
     * @return \Illuminate\Http\Response
     */
    public function destroy(bidang_kerja $bidang_kerja)
    {
        //
    }
}
