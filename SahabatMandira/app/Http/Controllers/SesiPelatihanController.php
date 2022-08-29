<?php

namespace App\Http\Controllers;

use App\SesiPelatihan;
use App\PelatihanPeserta;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SesiPelatihanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = SesiPelatihan::all();
        $user = User::join('roles as R', 'users.roles_id', '=', 'R.id')
        ->WHERE('R.nama_role', '=', 'verifikator' )
        ->get();
        // dd($data);
        // $data = SesiPelatihan::join('masterblk_db.paket_program as P', 'sesi_pelatihans.paket_program_id', '=', 'P.id')
        // ->join('masterblk_db.blks as B', 'P.blks_id', '=', 'B.id')
        // ->join('masterblk_db.kejuruans AS K', 'P.kejuruans_id', '=', 'K.id')
        // ->join('masterblk_db.sub_kejuruans AS S', 'P.sub_kejuruans_id', '=', 'S.id')
        // ->select('B.nama as blk','K.nama as kejuruan','S.nama as subkejuruan','sesi_pelatihans.lokasi','sesi_pelatihans.kuota','sesi_pelatihans.tanggal_seleksi','sesi_pelatihans.aktivitas',
        //         DB::raw('CONCAT( DATE_FORMAT(sesi_pelatihans.tanggal_pendaftaran,"%d-%m-%Y"), " - ", DATE_FORMAT(sesi_pelatihans.tanggal_tutup,"%d-%m-%Y")) AS pendaftaran'))
        // ->groupBy('B.nama','K.nama','S.nama','sesi_pelatihans.lokasi','sesi_pelatihans.kuota','sesi_pelatihans.tanggal_seleksi','sesi_pelatihans.aktivitas','pendaftaran')
        // ->get();

        $userLogin = auth()->user()->email;

        $peserta = User::join('mandira_db.pelatihan_pesertas as P', 'users.email', '=', 'P.email_peserta')
        ->join('mandira_db.sesi_pelatihans as S', 'P.sesi_pelatihans_id', '=', 'S.id')
        ->get();

        $dataInstruktur = SesiPelatihan::join('pelatihan_mentors as P', 'sesi_pelatihans.id', '=', 'P.sesi_pelatihans_id')
        ->WHERE('P.mentors_email', '=', $userLogin )
        ->get();

        return view('sesipelatihan.index', compact('dataInstruktur','data','user','peserta'));
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
        //dd($request);
        $sesi = new SesiPelatihan();
        $sesi->tanggal_pendaftaran = $request->tanggal_pendaftaran;
        $sesi->tanggal_tutup = $request->tanggal_tutup;
        $sesi->lokasi = $request->lokasi;
        $sesi->tanggal_mulai_pelatihan = $request->tanggal_mulai_pelatihan;
        $sesi->tanggal_selesai_pelatihan = $request->tanggal_selesai_pelatihan;
        $sesi->harga = $request->harga;
        $sesi->kuota = $request->kuota;
        $sesi->tanggal_seleksi = $request->tanggal_seleksi;
        $sesi->paket_program_id = $request->paket_program_id;
        $sesi->aktivitas = $request->aktivitas;
        $sesi->save();
        return redirect()->back()->with('success', 'Data sesi berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SesiPelatihan  $sesiPelatihan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        // return $id;
        $data = SesiPelatihan::where('id','=',$id)
        ->get();
        // $datas = $data->paketprogram;
        // dd($data);
        return view('sesipelatihan.detailPelatihan',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SesiPelatihan  $sesiPelatihan
     * @return \Illuminate\Http\Response
     */
    public function edit(SesiPelatihan $sesiPelatihan)
    {
        //
        return view('',compact('sesiPelatihan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SesiPelatihan  $sesiPelatihan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SesiPelatihan $sesiPelatihan)
    {
        //
        $sesiPelatihan->tanggal_pendaftaran = $request->tanggal_pendaftaran;
        $sesiPelatihan->	tanggal_tutup = $request->	tanggal_tutup;
        $sesiPelatihan->lokasi = $request->lokasi;
        $sesiPelatihan->tanggal_mulai_pelatihan = $request->tanggal_mulai_pelatihan;
        $sesiPelatihan->tanggal_selesai_pelatihan = $request->tanggal_selesai_pelatihan;
        $sesiPelatihan->harga = $request->harga;
        $sesiPelatihan->kuota = $request->kuota;
        $sesiPelatihan->tanggal_seleksi = $request->tanggal_seleksi;
        $sesiPelatihan->paket_program_id = $request->paket_program_id;
        $sesiPelatihan->aktivitas = $request->aktivitas;
        $sesiPelatihan->save();
        return redirect()->back()->with('success', 'Data sesi berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SesiPelatihan  $sesiPelatihan
     * @return \Illuminate\Http\Response
     */
    public function destroy(SesiPelatihan $sesiPelatihan)
    {
        //
        try {
            $sesiPelatihan->delete(); 
            return redirect()->route('')->with('success','Data BLK berhasil dihapus!');
        } catch (\PDOException $e) {
            $msg="Data gagal dihapus";

            return redirect()->route('')->with('error',$msg);
        }
    }

    public function getDetailPeserta(Request $request)
    {
        $sesi = SesiPelatihan::all()->where($request->id);
        // dd($sesi);
        // $lokasi = $sesi->;
        // $lokasi = $sesi->lokasi;
        return response()->json(array(
            'status'=>'oke',
            'data'=> $sesi
        ), 200);
    }

    public function pelatihanYangDiikuti(){

        $data = SesiPelatihan::all();
        return view('sesipelatihan.detailPelatihanYangDibuka',compact('data'));
    }
}
