<?php

namespace App\Http\Controllers\Bursa;

use App\Http\Controllers\Controller;
use App\Lowongan;
use App\Perusahaan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LowonganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $idperusahaan = Auth::user()->perusahaans_id_admin;
        $data_lowongan= Lowongan::where('perusahaans_id',$idperusahaan)->get();
        $perusahaan = Perusahaan::find($idperusahaan);
        return view('lowongan.index', compact('data_lowongan','perusahaan'));
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
        $lowongan->nama = $request->nama;
        $lowongan->posisi=$request->posisi;
        $lowongan->lokasi_kerja=$request->lokasi_kerja;
        $lowongan->jam_kerja=$request->jam_kerja;
        $lowongan->pengalaman_kerja=$request->pengalaman_kerja;
        $lowongan->pendidikan_terakhir=$request->pendidikan_terakhir;
        $lowongan->deskripsi_kerja=$request->deskripsi_kerja;
        $lowongan->profile_perusahaan=$request->profile_perusahaan;
        $lowongan->tanggal_pemasangan = $request->tanggal_pemasangan;
        $lowongan->perusahaans_id = $request->perusahaans_id;
        $lowongan->gaji=$request->gaji;
        // $lowongan->created_at = carbon::now()->format('Y-m-d H:i:m');
        // $lowongan->updated_at = carbon::now()->format('Y-m-d H:i:m');
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
        $lowongan = new Lowongan();
        $lowongan->posisi=$request->posisi;
        $lowongan->pengalaman_kerja=$request->pengalaman_kerja;
        $lowongan->lokasi_kerja=$request->lokasi_kerja;
        $lowongan->gaji=$request->gaji;
        $lowongan->pendidikan_terakhir=$request->pendidikan_terakhir;
        $lowongan->jam_kerja=$request->jam_kerja;
        $lowongan->deskripsi_kerja=$request->deskripsi_kerja;
        $lowongan->profile_perusahaan=$request->profile_perusahaan;
        $lowongan->tanggal_pemasangan = carbon::now()->format('Y-m-d H:i:m');
        $lowongan->save();
        return redirect()->route('lowongan.index')->with('success', 'Data Lowongan berhasil diubah!');
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
        try {
            $lowongan->delete(); 
            return redirect()->route('lowongan.index')->with('success','Data Lowongan berhasil dihapus!');
        } catch (\PDOException $e) {
            $msg="Data gagal dihapus";

            return redirect()->route('lowongan.index')->with('error',$msg);
        }
    }

    public function getEdit(Request $request)
    {
        $lowongan = Lowongan::find($request->id);
        return response()->json(array(
            'status'=>'oke',
            'msg'=>view('lowongan.modal', compact('lowongan'))->render() 
        ), 200);
    }
}
