<?php

namespace App\Http\Controllers\Bursa;

use App\DokumenLowongan;
use App\Http\Controllers\Controller;
use App\Lamaran;
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

        $validatedData = $request->validate([
            'deskripsi_kerja' => 'required',
            'kualifikasi_minimal' => 'required',
            'dokumen' => 'required',
            'nama' => 'required',
            'posisi' => 'required',
            'tanggal_pemasangan'=>'required',
            'tanggal_kadaluarsa'=>'required',
        ]);
        // dd($request);
        $lowongan = new Lowongan();
        $lowongan->deskripsi_kerja=$validatedData['deskripsi_kerja'];
        $lowongan->kualifikasi_minimal=$validatedData['kualifikasi_minimal'];
        $lowongan->perusahaans_id = $request->perusahaans_id;
        $lowongan->nama = $validatedData['nama'];
        $lowongan->posisi=$validatedData['posisi'];
        $lowongan->tanggal_pemasangan = $validatedData['tanggal_pemasangan'];
        $lowongan->tanggal_kadaluarsa = $validatedData['tanggal_kadaluarsa'];
        // $lowongan->lokasi_kerja=$request->lokasi_kerja;
        // $lowongan->jam_kerja=$request->jam_kerja;
        // $lowongan->pengalaman_kerja=$request->pengalaman_kerja;
        // $lowongan->pendidikan_terakhir=$request->pendidikan_terakhir;
        // $lowongan->profile_perusahaan=$request->profile_perusahaan;
        // $lowongan->gaji=$request->gaji;

        // $lowongan->created_at = carbon::now()->format('Y-m-d H:i:m');
        // $lowongan->updated_at = carbon::now()->format('Y-m-d H:i:m');
        $lowongan->save();

        foreach ($validatedData['dokumen'] as $dokumen) {
            $dokumenLowongan = new DokumenLowongan();
            $dokumenLowongan->nama = $dokumen;
            $dokumenLowongan->lowongans_id = $lowongan->id;
            $dokumenLowongan->save();
        }
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
        $lamaran = Lamaran::where('lowongans_id',$lowongan->id)->where('users_email', Auth::user()->email)->first();
        return view('lowongan.detaillowongan',compact('lowongan','lamaran'));
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
        $lowongan->nama = $request->nama;
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

    public function semuaLowongan()
    {
        $lowongans = Lowongan::all();
        return view('lowongan.semualowongan', compact('lowongans'));
    }
}
