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
use App\MandiraMentoring;
use App\PelatihanVendor;
use Carbon\Carbon;

class SesiPelatihanController extends Controller
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
        $blk = null;
        if (auth()->user()->role->nama_role == 'adminblk') {

            $blk_id = auth()->user()->blks_id_admin;

            //mengambil data dari tabel sesi pelatihan dan tabel paket program sesuai dengan id sesi pelatihan id blk sesuai dengan login
            $data = SesiPelatihan::join('masterblk_db.paket_program as p','p.id','=','sesi_pelatihans.paket_program_id')
            ->where('blks_id',$blk_id)
            ->where('sesi_pelatihans.is_delete',0)
            ->select('sesi_pelatihans.*')
            ->get();
            $blk = DB::table('blks')->select('nama')->where('id',$blk_id)->get();

        } else {

            $data = SesiPelatihan::all();

        }

        // mengambil data user
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

        //mengambiil data peserta dari sisi admin blk
        $peserta = User::join('mandira_db.pelatihan_pesertas as P', 'users.email', '=', 'P.email_peserta')
            ->join('mandira_db.sesi_pelatihans as S', 'P.sesi_pelatihans_id', '=', 'S.id')
            ->where('S.is_delete',0)
            ->get();

        // mengambil data instruktur yang login
        $dataInstruktur = SesiPelatihan::join('pelatihan_mentors as P', 'sesi_pelatihans.id', '=', 'P.sesi_pelatihans_id')
            ->WHERE('P.mentors_email', '=', $userLogin)
            ->where('sesi_pelatihans.is_delete',0)
            ->get();

        // mengambil data peserta dari peserta yang login
        $dataPeserta = SesiPelatihan::JOIN('pelatihan_pesertas as p', 'p.sesi_pelatihans_id', '=', 'sesi_pelatihans.id')
            ->join('masterblk_db.users as u', 'u.email', '=', 'p.email_peserta')
            ->WHERE('p.email_peserta', '=', $userLogin)
            ->where('sesi_pelatihans.is_delete',0)
            ->get();

        $pesertaDiterima = PelatihanPeserta::Where('status_fase', 'DITERIMA')->get();

        $selectedSumberDana = SesiPelatihan::first()->sumber_dana;

        return view('sesipelatihan.index', compact('dataInstruktur', 'data', 'user', 'peserta', 'dataPeserta','blk', 'selectedSumberDana','pesertaDiterima'));
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
        if (!$request->hasFile('fotoPelatihan')) {
            return redirect()->back()->with('error', 'Tidak ada data foto, tolong untuk memasukan foto');
        }

        // mengirim atau memasukkan data sesi pelatihan dari UI ke tabel sesi_pelatihans
        $sesi = new SesiPelatihan();
        $sesi->tanggal_pendaftaran = $request->tanggal_pendaftaran;
        $sesi->tanggal_tutup = $request->tanggal_tutup;
        $sesi->lokasi = $request->lokasi;
        $sesi->tanggal_mulai_pelatihan = $request->tanggal_mulai_pelatihan;
        $sesi->tanggal_selesai_pelatihan = $request->tanggal_selesai_pelatihan;
        $sesi->harga = $request->harga;
        $sesi->kuota = $request->kuota;
        $sesi->kuota_daftar = $request->kuota_daftar;
        $sesi->tanggal_seleksi = $request->tanggal_seleksi;
        $sesi->paket_program_id = $request->paket_program_id;
        $sesi->jamPelajaran = $request->jamPelajaran;
        $sesi->nomorSurat = $request->nomorSurat;
        $sesi->tanggalSurat = $request->tanggalSurat;
        $sesi->tanggalSertif = $request->tanggalSertif;
        $sesi->aktivitas = $request->aktivitas;
        $sesi->deskripsi = $request->deskripsi;
        $sesi->tanggal_mulai_daftar_ulang = $request->tanggalMulaiDaftarUlang;
        $sesi->tanggal_selesai_daftar_ulang = $request->tanggalSelesaiDaftarUlang;
        $sesi->sumber_dana =$request->sumberDana;
        $sesi->nilai_minimal_lulus = $request->nilaiMinimalLulus;

        $foto = $request->file('fotoPelatihan')->store('programPelatihan');

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
        $data = SesiPelatihan::where('id', '=', $id)
            ->get();
        $mentor = PelatihanMentor::where('sesi_pelatihans_id', '=', $id)
            ->get();

        //ambil data user yang sedang login
        $userLogin = auth()->user()->email;

        //melakukan pengecekan apakah user yang login sudah pernah melakukan pendaftaran (?)
        $cekDaftar = PelatihanPeserta::where('sesi_pelatihans_id', '=', $id)
            ->where('email_peserta', '=', $userLogin)->get();
        // dd($cekDaftar);
        $cekTanggalDaftarUlang = PelatihanPeserta::where('email_peserta', $userLogin)->max('tanggal_daftar_ulang');
        return view('sesipelatihan.detailPelatihan', compact('data', 'mentor', 'cekDaftar','cekTanggalDaftarUlang'));
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
        if (!$request->hasFile('fotoPelatihan')) {
            return redirect()->back()->with('error', 'Tidak ada data foto, tolong untuk memasukan foto');
        }

        //melakukan update ke database tabel sesi_pelatihans
        $sesiPelatihan->tanggal_pendaftaran = $request->tanggal_pendaftaran;
        $sesiPelatihan->tanggal_tutup = $request->tanggal_tutup;
        $sesiPelatihan->deskripsi = $request->deskripsi;
        $sesiPelatihan->lokasi = $request->lokasi;
        $sesiPelatihan->tanggal_mulai_pelatihan = $request->tanggal_mulai_pelatihan;
        $sesiPelatihan->tanggal_selesai_pelatihan = $request->tanggal_selesai_pelatihan;
        $sesiPelatihan->harga = $request->harga;
        $sesiPelatihan->kuota = $request->kuota;
        $sesiPelatihan->kuota_daftar = $request->kuota_daftar;
        $sesiPelatihan->tanggal_seleksi = $request->tanggal_seleksi;
        $sesiPelatihan->paket_program_id = $request->paket_program_id;
        $sesiPelatihan->jamPelajaran = $request->jamPelajaran;
        $sesiPelatihan->nomorSurat = $request->nomorSurat;
        $sesiPelatihan->tanggalSurat = $request->tanggalSurat;
        $sesiPelatihan->tanggalSertif = $request->tanggalSertif;
        $sesiPelatihan->aktivitas = $request->aktivitas;
        $sesiPelatihan->tanggal_mulai_daftar_ulang = $request->tanggalMulaiDaftarUlang;
        $sesiPelatihan->tanggal_selesai_daftar_ulang = $request->tanggalSelesaiDaftarUlang;
        $sesiPelatihan->sumber_dana = $request->sumberDana;
        $sesiPelatihan->nilai_minimal_lulus = $request->nilaiMinimalLulus;
        $foto = $request->file('fotoPelatihan')->store('programPelatihan');

        $sesiPelatihan->gambar_pelatihan = $foto;
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
        // mengambil id sesi pelatihan
        $id_sesi = $sesiPelatihan->id;

        try {
            //$delete_peserta = PelatihanPeserta::WHERE('sesi_pelatihans_id', $id_sesi)->delete();

            //hapus pakai is delete.
            $sesiPelatihan->is_delete = 1;
            $sesiPelatihan->save();
            return redirect()->back()->with('success', 'Data Sesi Pelatihan berhasil dihapus!');
        } catch (\PDOException $e) {
            $msg = "Data gagal dihapus";

            return redirect()->back()->with('error', $msg);
        }
    }

    public function getDetailPeserta(Request $request)
    {
        //mengambil data sesi pelatihan sesuai dengan id
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
        //mengambil data sesi pelatihan
        $data = SesiPelatihan::all();
        // dd($data);
        return view('pelatihanPeserta.pelatihanYangDiikuti', compact('data'));
    }


    //untuk tombol show more pada dashboard
    public function showMore($id)
    {
        // mengambil username atau email orang yang sedang login
        $userLogin = auth()->user()->email;
        $mytime = Carbon::now();

        //sesi pelatihan yang di tawarkan oleh blk
        if ($id == '1') {
            $data = SesiPelatihan::Where('tanggal_tutup', '>=', $mytime)
            ->get();
            $sesi = '0';

            //sesi pelatihan yang ditawarkan oleh mentor
        } elseif ($id == '2') {
            $data = MandiraMentoring::join('masterblk_db.users as u','u.email','=','mandira_mentorings.email_mentor')
            ->where('is_validated','=',1)
            ->Where('tgl_ditutup', '>=', $mytime)
            ->get();
            //
            $sesi = '2';

            //sesi pelatihan dari vendor (UGA)
        } else {
            $data = PelatihanVendor::all();
            $sesi = '1';
        }

        //
        // dd($data);
        return view('sesipelatihan.detailPelatihanYangDibuka', compact('data', 'sesi','id'));
    }

    public function daftarPelatihan()
    {

        //ambil siapa yang login
        $userLogin = auth()->user()->email;
        // $dataInstruktur = SesiPelatihan::join('pelatihan_mentors as P', 'sesi_pelatihans.id', '=', 'P.sesi_pelatihans_id')
        //     ->get();
        //
        $blk = null;

        //jika yang login adalah admin blk
        if (auth()->user()->role->nama_role == 'adminblk') {

            //ambil data blk sesuai dengan admin blk yang login
            $blk_id = auth()->user()->blks_id_admin;

            //mengambil data instruktur berdasarkan sesi pelatihan (?)
            $dataInstruktur = SesiPelatihan::join('pelatihan_mentors as P', 'sesi_pelatihans.id', '=', 'P.sesi_pelatihans_id')
            ->join('masterblk_db.paket_program as p','p.id','=','sesi_pelatihans.paket_program_id')
            ->where('blks_id',$blk_id)->where('sesi_pelatihans.is_delete',0)->select('sesi_pelatihans.*')->get(); //get semua data sesi
            $blk = DB::table('blks')->select('nama')->where('id',$blk_id)->get(); // get data nama

        } else {

            //
            $dataInstruktur = SesiPelatihan::join('pelatihan_mentors as P', 'sesi_pelatihans.id', '=', 'P.sesi_pelatihans_id')
            ->where('sesi_pelatihans.is_delete',0)
            ->select('sesi_pelatihans.*')
            ->get();

        }
        $mentor = User::join('roles as R', 'users.roles_id', '=', 'R.id')
            ->WHERE('R.nama_role', '=', 'verifikator')
            ->get();

        return view('sesipelatihan.daftarPelatihan', compact('dataInstruktur', 'mentor', 'userLogin','blk'));
    }

    public function daftarUlang(Request $request)
    {
        $peserta = $request->email;

        $update = array(
            'is_daftar_ulang' => 1,
            'tanggal_daftar_ulang' => date('Y-m-d H:i:s'),
        );

        DB::connection('mandira')
            ->table('pelatihan_pesertas')
            ->where('sesi_pelatihans_id', $request->get('sesi_pelatihans_id'))
            ->where('email_peserta', $peserta)
            ->update($update);
        //
        // $dataPeserta = SesiPelatihan::JOIN('pelatihan_pesertas as p', 'p.sesi_pelatihans_id', '=', 'sesi_pelatihans.id')
        //     ->join('masterblk_db.users as u', 'u.email', '=', 'p.email_peserta')
        //     ->WHERE('p.email_peserta', '=', $userLogin)
        //     ->get();
        // //
        return redirect()->back()->with('success', 'Berhasil Daftar Ulang');
    }

    public function getEditForm(Request $request)
    {
        $sesiPelatihan = SesiPelatihan::find($request->id);
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('sesipelatihan.modal', compact('sesiPelatihan'))->render()
        ), 200);
    }

    //menampilkan form detail
    public function getDetail(Request $request)
    {
        $sesi = SesiPelatihan::find($request->id);
        // dd($sesi);
        $aktivitas = $sesi->aktivitas;
        return response()->json(array(
            'status'=>'oke',
            'data'=> $aktivitas
        ), 200);
    }

    public function getTambahInstruktr(Request $request)
    {

        //ambil user yang masuk dari blk mana
        $blk_id = Auth()->user()->blks_id_admin;
        //ambil id sesi pelatihan
        $idsesipelatihan = $request->id;
        //ambil data semua instruktur yang ada di blk sesuai dengan id
        $instrukturs = User::join('roles as R', 'users.roles_id', '=', 'R.id')
        ->WHERE('R.nama_role', '=', 'verifikator')
        ->WHERE('users.blks_id_admin',$blk_id)
        ->get();
        // dd($instrukturs);
        return response()->json(array(
            'status'=>'oke',
            'msg'=> view('sesipelatihan.modalTambahInstruktur', compact('blk_id','instrukturs','idsesipelatihan'))->render()
        ), 200);
    }

    public function storeMTU(Request $request)
    {
        // return($request);
        if (!$request->hasFile('fotoPelatihan')) {
            return redirect()->back()->with('error', 'Tidak ada data foto, tolong untuk memasukan foto');
        }

        // melakukan insert ke database tabel pelatihan_mtus
        $sesi = new SesiPelatihan();
        $sesi->tanggal_pendaftaran = $request->tanggal_pendaftaran;
        $sesi->tanggal_tutup = $request->tanggal_tutup;
        $sesi->lokasi = $request->lokasi;
        $sesi->tanggal_mulai_pelatihan = $request->tanggal_mulai_pelatihan;
        $sesi->tanggal_selesai_pelatihan = $request->tanggal_selesai_pelatihan;
        $sesi->harga = $request->harga;
        $sesi->kuota = $request->kuota;
        $sesi->kuota_daftar = $request->kuota_daftar;
        $sesi->paket_program_id = $request->paket_program_id;
        $sesi->jamPelajaran = $request->jamPelajaran;
        $sesi->aktivitas = $request->aktivitas;
        $sesi->deskripsi = $request->deskripsi;
        $sesi->tanggal_mulai_daftar_ulang = $request->tanggalMulaiDaftarUlang;
        $sesi->tanggal_selesai_daftar_ulang = $request->tanggalSelesaiDaftarUlang;
        $sesi->sumber_dana =$request->sumberDana;
        $sesi->is_mtu = 1;

        $foto = $request->file('fotoPelatihan')->store('programPelatihan');
        // $name = $foto->getClientOriginalName();
        // $foto->move('images/programPelatihan', $name);

        $sesi->gambar_pelatihan = $foto;
        $sesi->save();
        return redirect()->back()->with('success', 'Data pelatihan MTU berhasil ditambahkan!');
    }
}
