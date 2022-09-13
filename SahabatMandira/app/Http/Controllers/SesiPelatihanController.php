<?php

namespace App\Http\Controllers;

use App\SesiPelatihan;
use App\PelatihanPeserta;
use App\PelatihanMentor;
use App\User;
use App\PelatihanOther;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use File;
use App\Http\Controllers\Controller;
use App\PelatihanVendor;

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
            ->WHERE('R.nama_role', '=', 'verifikator')
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
        // dd($userLogin);

        $peserta = User::join('mandira_db.pelatihan_pesertas as P', 'users.email', '=', 'P.email_peserta')
            ->join('mandira_db.sesi_pelatihans as S', 'P.sesi_pelatihans_id', '=', 'S.id')
            ->get();

        $dataInstruktur = SesiPelatihan::join('pelatihan_mentors as P', 'sesi_pelatihans.id', '=', 'P.sesi_pelatihans_id')
            ->WHERE('P.mentors_email', '=', $userLogin)
            ->get();

        $dataPeserta = SesiPelatihan::JOIN('pelatihan_pesertas as p', 'p.sesi_pelatihans_id', '=', 'sesi_pelatihans.id')
            ->join('masterblk_db.users as u', 'u.email', '=', 'p.email_peserta')
            ->WHERE('p.email_peserta', '=', $userLogin)
            ->get();
        //
        // $dataPeserta = User::join('mandira_db.pelatihan_pesertas as p', 'p.email_peserta', '=', 'users.email')
        // ->where('p.email_peserta', 'peserta15@gmail.com')
        // ->where('p.sesi_pelatihans_id', '2')
        //     ->get();
        // dd($dataPeserta);

        return view('sesipelatihan.index', compact('dataInstruktur', 'data', 'user', 'peserta', 'dataPeserta'));
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
        // return($request);
        if (!$request->hasFile('fotoPelatihan')) {
            return redirect()->back()->with('error', 'Tidak ada data foto, tolong untuk memasukan foto');
        }
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
        $sesi->deskripsi = $request->deskripsi;

        //insert foto (maaf gk bisa elequent [yobong])
        $foto = $request->file('fotoPelatihan')->store('programPelatihan');
        // $name = $foto->getClientOriginalName();
        // $foto->move('images/programPelatihan', $name);


        $sesi->gambar_pelatihan = $foto;
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
        $data = SesiPelatihan::where('id', '=', $id)
            ->get();

        // $data = DB::connection('mandira')
        //         ->table('pelatihan_mentors as pm')
        //         ->join('masterblk_db.paket_program as s', 'pm.sesi_pelatihans_id', '=', 's.id')
        //         ->join('sesi_pelatihans as s', 'pm.sesi_pelatihans_id', '=', 's.id')
        //         ->where('sesi_pelatihans_id',$id)
        //         ->get();

        // dd($data);
        $mentor = PelatihanMentor::where('sesi_pelatihans_id', '=', $id)
            ->get();
        // $datas = $data->paketprogram;
        $userLogin = auth()->user()->email;
        $cekDaftar = PelatihanPeserta::where('sesi_pelatihans_id', '=', $id)
        ->where('email_peserta', '=', $userLogin)->get();
        // dd($cekDaftar);
        return view('sesipelatihan.detailPelatihan', compact('data', 'mentor','cekDaftar'));
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
        return view('', compact('sesiPelatihan'));
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
        $sesiPelatihan->tanggal_tutup = $request->tanggal_tutup;
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
            return redirect()->route('')->with('success', 'Data BLK berhasil dihapus!');
        } catch (\PDOException $e) {
            $msg = "Data gagal dihapus";

            return redirect()->route('')->with('error', $msg);
        }
    }

    public function getDetailPeserta(Request $request)
    {
        $sesi = SesiPelatihan::all()->where($request->id);
        // dd($sesi);
        // $lokasi = $sesi->;
        // $lokasi = $sesi->lokasi;
        return response()->json(array(
            'status' => 'oke',
            'data' => $sesi
        ), 200);
    }

    public function riwayatPelatihan()
    {

        $data = SesiPelatihan::all();
        // dd($data);
        return view('pelatihanPeserta.pelatihanYangDiikuti', compact('data'));
    }

    public function showMore($id)
    {
        $userLogin = auth()->user()->email;
        if ($id == '1') {
            $data = SesiPelatihan::all()->Where('tanggal_tutup', '<=', 'CURDATE()');
            $sesi = '0';
        } elseif ($id == '2') {
            $data = SesiPelatihan::JOIN('pelatihan_pesertas as p', 'sesi_pelatihans.id', '=', 'p.sesi_pelatihans_id')
                ->WHERE('p.email_peserta', '=', $userLogin)
                ->WHERE('p.is_sesuai_minat', '=', '1')
                ->get();
            //
            $sesi = '0';
        } else {
            $data = PelatihanVendor::all();
            $sesi = '1';
        }

        // 
        // dd($data);
        return view('sesipelatihan.detailPelatihanYangDibuka', compact('data', 'sesi'));
    }

    public function daftarPelatihan()
    {
        $userLogin = auth()->user()->email;
        $dataInstruktur = SesiPelatihan::join('pelatihan_mentors as P', 'sesi_pelatihans.id', '=', 'P.sesi_pelatihans_id')
            ->get();
        //
        $mentor = User::join('roles as R', 'users.roles_id', '=', 'R.id')
        ->WHERE('R.nama_role', '=', 'verifikator')
        ->get();
        return view('sesipelatihan.daftarPelatihan', compact('dataInstruktur','mentor','userLogin'));
    }

    public function daftarUlang(Request $request)
    {
        $userLogin = auth()->user()->email;

        $update = array(
            'is_daftar_ulang' => 1,
            'tanggal_daftar_ulang' => date('Y-m-d H:i:s'),
            'status_fase' => 'SEDANG PROSES PELATIHAN',
        );

        DB::connection('mandira')
            ->table('pelatihan_pesertas')
            ->where('sesi_pelatihans_id', $request->get('sesi_pelatihans_id'))
            ->where('email_peserta', $userLogin)
            ->update($update);
        //
        $dataPeserta = SesiPelatihan::JOIN('pelatihan_pesertas as p', 'p.sesi_pelatihans_id', '=', 'sesi_pelatihans.id')
            ->join('masterblk_db.users as u', 'u.email', '=', 'p.email_peserta')
            ->WHERE('p.email_peserta', '=', $userLogin)
            ->get();
        //
        return redirect()->back()->with('success', 'Berhasil Daftar Ulang');
    }
}
