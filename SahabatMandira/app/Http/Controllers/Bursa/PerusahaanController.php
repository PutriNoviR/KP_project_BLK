<?php

namespace App\Http\Controllers\Bursa;

use App\Perusahaan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PerusahaanController extends Controller
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
        return view ("perusahaan.create");
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
        $perusahaan = new Perusahaan();
        $perusahaan->nama=$request->nama;
        $perusahaan->bidang=$request->bidang;
        $perusahaan->alamat=$request->alamat;
        $perusahaan->kode_pos=$request->kode_pos;
        $perusahaan->no_telp=$request->no_telp;
        $perusahaan->email=$request->email;
        $perusahaan->tentang_perusahaan=$request->tentang_perusahaan;
        $perusahaan->save();
        return redirect()->back()->with('success', 'Data Perusahaan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function posting()
    {
        //compact untuk kirim data
        $lowongan = Lowongan::all();
        return view("welcome", compact("lowongan"));
    }
}
