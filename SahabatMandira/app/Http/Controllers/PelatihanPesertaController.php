<?php

namespace App\Http\Controllers;

use App\PelatihanPeserta;
use App\SesiPelatihan;
use App\User;
use Auth;
use DB;
use Illuminate\Http\Request;

class PelatihanPesertaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = PelatihanPeserta::all();

        $peserta = User::join('mandira_db.pelatihan_pesertas as P', 'users.email', '=', 'P.email_peserta')
            ->join('mandira_db.sesi_pelatihans as S', 'P.sesi_pelatihans_id', '=', 'S.id')
            ->get();
        return view('pelatihanpeserta.index', compact('data', 'peserta'));
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
    public function store(Request $request, $id)
    {
        //
        // $email = auth()->user()->email;
        // $insert = array(
        //     'email' => $email,
        //     'sesi_pelatihans_id' => $id,
        //     'status' => $request->get('status'),
        //     'tanggal_seleksi' => $request->get('tanggal_seleksi'),
        // );

        // DB::connection('mandira')
        //     ->table('pelatihan_pesertas')
        //     ->insert($insert);


        // //

        // $data = DB::connection('mandira')
        //         ->table('pelatihan_pesertas as pp')
        //         ->join('masterblk_db.users as u', 'pp.email_peserta', '=', 'u.email')
        //         ->join('sesi_pelatihans as s', 'pp.sesi_pelatihans_id', '=', 's.id')
        //         ->where('sesi_pelatihans_id',$id)
        //         ->get();
        // //
        // // dd($data);
        // return redirect()->route('pelatihanpeserta.jadwalSeleksi', compact('data'))->with('success', 'Berhasil Mendaftar');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PelatihanPeserta  $pelatihanPeserta
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userLogin = auth()->user()->email;
        $periode = SesiPelatihan::find($id);
        // $pelatihan = ::find($id);
        $data = DB::connection('mandira')
            ->table('pelatihan_pesertas as pp')
            ->join('masterblk_db.users as u', 'pp.email_peserta', '=', 'u.email')
            ->where('sesi_pelatihans_id', $id)
            ->get();
        return view('pelatihanpeserta.index', compact('data', 'periode'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PelatihanPeserta  $pelatihanPeserta
     * @return \Illuminate\Http\Response
     */
    public function edit(PelatihanPeserta $pelatihanPeserta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PelatihanPeserta  $pelatihanPeserta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $email)
    {
        $idSesiPelatihan = $request->get('sesi_pelatihans_id');
        $listditerima = DB::connection('mandira')
            ->table('pelatihan_pesertas')
            ->where('sesi_pelatihans_id', $idSesiPelatihan)
            ->where('status_fase', 'DITERIMA')
            ->get();

        $countDiterima = $listditerima->count();

        $kuota = DB::connection('mandira')
        ->table('sesi_pelatihans')
        ->where('id',$idSesiPelatihan)->value('kuota');
        // dd($kuota);

        if ($countDiterima <= $kuota) {
            // dd('1');
            if ($request->get('rekom_keputusan') == 'LULUS') {
                $update = array(
                    'rekom_catatan' => $request->get('rekom_catatan'),
                    'rekom_nilai_TPA' => $request->get('rekom_nilai_TPA'),
                    'rekom_keputusan' => $request->get('rekom_keputusan'),
                    'rekom_is_permanent' => $request->get('rekom_is_permanent'),
                    'status_fase' => 'DITERIMA',
                );
            } elseif (($request->get('rekom_keputusan') == 'TIDAK LULUS') || ($request->get('rekom_keputusan') == 'MENGUNDURKAN DIRI')) {
                $update = array(
                    'rekom_catatan' => $request->get('rekom_catatan'),
                    'rekom_nilai_TPA' => $request->get('rekom_nilai_TPA'),
                    'rekom_keputusan' => $request->get('rekom_keputusan'),
                    'rekom_is_permanent' => $request->get('rekom_is_permanent'),
                    'status_fase' => 'DITOLAK',
                );
            } elseif (($request->get('rekom_keputusan') == 'CADANGAN')) {
                $update = array(
                    'rekom_catatan' => $request->get('rekom_catatan'),
                    'rekom_nilai_TPA' => $request->get('rekom_nilai_TPA'),
                    'rekom_keputusan' => $request->get('rekom_keputusan'),
                    'rekom_is_permanent' => $request->get('rekom_is_permanent'),
                    'status_fase' => 'PESERTA CADANGAN',
                );
            }

            DB::connection('mandira')
                ->table('pelatihan_pesertas')
                ->where('sesi_pelatihans_id', $request->get('sesi_pelatihans_id'))
                ->where('email_peserta', $email)
                ->update($update);

            return redirect()->back()->with('success', 'Berhasil Mengupdate');

        } else {

            return redirect()->back()->with('failed', 'Gagal Update! Jumlah diterima sudah max kuota!.');

        }


        //
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PelatihanPeserta  $pelatihanPeserta
     * @return \Illuminate\Http\Response
     */
    public function destroy(PelatihanPeserta $pelatihanPeserta)
    {
        //
    }

    public function lengkapiBerkas($idpelatihan)
    {
        $userLogin = auth()->user()->email;
        $data = User::all()->where('email', '=', $userLogin);
        return view('pelatihanpeserta.kelengkapanDokumen', compact('data', 'idpelatihan'));
    }

    public function pendaftaran()
    {
        return view('pelatihanpeserta.pendaftaranPeserta');
    }
    public function getEditForm(Request $request)
    {
        $email = $request->email_peserta;
        $id = $request->sesi_pelatihans_id;
        $data = DB::connection('mandira')
            ->table('pelatihan_pesertas as pp')
            ->JOIN('sesi_pelatihans as s','pp.sesi_pelatihans_id','s.id')
            ->where('email_peserta', $email)
            ->where('sesi_pelatihans_id', $id)
            ->SELECT('pp.*','s.tanggal_seleksi as tgl_seleksi')
            ->first();
        //
        $check = '1';
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('pelatihanpeserta.modal', compact('data', 'check'))->render()
        ), 200);
    }

    public function getKompetensiForm(Request $request)
    {
        $email = $request->email_peserta;
        $id = $request->sesi_pelatihans_id;
        // $data = PelatihanPeserta::all()->WHERE('email_peserta','=', $email);
        $data = DB::connection('mandira')
            ->table('pelatihan_pesertas as pp')
            ->where('email_peserta', $email)
            ->where('sesi_pelatihans_id', $id)
            ->first();
        $check = '0';
        // $data = PelatihanPeserta::find($request->id);
        // dd($email);
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('pelatihanpeserta.modal', compact('data', 'check'))->render()
        ), 200);
    }

    public function storePendaftar(Request $request, $id)
    {
        $userLogin = auth()->user()->email;

        $cnt_daftar = DB::connection('mandira')
        ->table('sesi_pelatihans as s')
        ->LEFTJOIN('pelatihan_pesertas as p','s.id','p.sesi_pelatihans_id')
        ->where('s.id',$id)
        ->selectRaw("IFNULL(COUNT(p.email_peserta),0) as pendaftar, s.kuota_daftar")
        ->GROUPBY('s.kuota_daftar')
        ->first();

        // dd($cnt_daftar);
        
        $cekdaftartahunan = PelatihanPeserta::JOIN('sesi_pelatihans as s', 'pelatihan_pesertas.sesi_pelatihans_id', 's.id')
        ->whereRaw("pelatihan_pesertas.email_peserta = '$userLogin' AND YEAR(s.tanggal_tutup) = YEAR(CURDATE()) AND pelatihan_pesertas.rekom_keputusan IN ('LULUS', 'CADANGAN', 'MENGUNDURKAN DIRI')")
        ->count();

        $cekDaftar = PelatihanPeserta::where('sesi_pelatihans_id', '=', $id)
        ->where('email_peserta', '=', $userLogin)
        ->count();

        $cekseleksiaktif = PelatihanPeserta::JOIN('sesi_pelatihans as s', 'pelatihan_pesertas.sesi_pelatihans_id', 's.id')
        ->whereRaw("pelatihan_pesertas.email_peserta = '$userLogin' AND (YEAR(s.tanggal_mulai_pelatihan) = YEAR(CURDATE()) AND s.tanggal_mulai_pelatihan > CURDATE()) AND pelatihan_pesertas.status_fase = 'DALAM SELEKSI'")
        ->count();

        if($cekdaftartahunan > 0)
        {
            return redirect()->back()->with('error', 'Anda pernah mengikuti/menyelesaikan/mengundurkan diri dari pelatihan pada tahun yang sama. Silahkan anda join pada pelatihan tahun mendatang !');
        }
        elseif($cekseleksiaktif > 0)
        {
            if($cekDaftar > 0)
            {
                return redirect()->back()->with('error', 'Anda sudah terdaftar pada pelatihan ini. Silahkan ikuti prosedur untuk menyelesaikan proses seleksi !');    
            }
            else
            {
                return redirect()->back()->with('error', 'Anda sedang dalam proses seleksi sebuah pelatihan. Mohon selesaikan seleksi terlebih dahulu !');
            }
        }
        else
        {

            if($cnt_daftar->pendaftar >= $cnt_daftar->kuota_daftar)
            {
                return redirect()->back()->with('error', 'Mohon maaf, jumlah pendaftar untuk sesi pelatihan ini telah mencapai batas kuota !');
            }
            else
            {
                $emailValidator = DB::connection('mandira')
                ->table('pelatihan_mentors')
                ->where('sesi_pelatihans_id', $id)
                ->value('mentors_email');

                $emailUser = auth()->user()->email;
                // dd($emailValidator);

                $insert = array(
                    'email_peserta' => $emailUser,
                    'sesi_pelatihans_id' => $id,
                    'tanggal_seleksi' => $request->get('tanggal_seleksi'),
                    'rekom_validator' => $emailValidator,
                );

                DB::connection('mandira')
                    ->table('pelatihan_pesertas')
                    ->insert($insert);

                //
                $data = DB::connection('mandira')
                    ->table('pelatihan_pesertas as pp')
                    ->join('sesi_pelatihans as s', 'pp.sesi_pelatihans_id', '=', 's.id')
                    ->join('masterblk_db.users as u', 'pp.email_peserta', '=', 'u.email')
                    ->join('masterblk_db.paket_program as pr', 'pr.id', '=', 's.paket_program_id')
                    ->join('masterblk_db.blks as b','pr.blks_id','b.id')
                    ->join('masterblk_db.sub_kejuruans as sk','pr.sub_kejuruans_id','sk.id')
                    ->join('masterblk_db.kejuruans as k','pr.kejuruans_id','k.id')
                    ->where('s.id', $id)
                    ->where('u.email',$emailUser)
                    ->selectRaw("CONCAT(u.nama_depan,' ',u.nama_belakang) AS nama, b.nama as blk, k.nama as kejuruan, sk.nama as subkejuruan, s.lokasi, s.tanggal_mulai_pelatihan as mulai, s.tanggal_selesai_pelatihan as selesai")
                    ->first();

                //

                DB::connection('mandira')
                    ->table('pelatihan_pesertas')
                    ->where('sesi_pelatihans_id', $id)
                    ->where('email_peserta', $emailUser)
                    ->update(['status_fase' => 'DALAM SELEKSI']);

                // return $data2;
                return view('pelatihanpeserta.jadwalSeleksi', compact('data'));
            }
            
        }
    }

    public function urutan($id)
    {
        $email = auth()->user()->email;
        // $data = DB::connection('mandira')
        //     ->table('pelatihan_pesertas as pp')
        //     ->join('masterblk_db.users as u', 'pp.email_peserta', '=', 'u.email')
        //     ->join('sesi_pelatihans as s', 'pp.sesi_pelatihans_id', '=', 's.id')
        //     ->where('sesi_pelatihans_id', $id)
        //     ->where('u.email', '=', $email)
        //     ->first();
        $data = PelatihanPeserta::where('sesi_pelatihans_id', $id)
            ->where('u.email', '=', $email)
            ->first();
        // dd($data);
        view('pelatihanpeserta.jadwalSeleksi', compact('data'));
    }

    public function updateKompetensi(Request $request, $email)
    {
        // return $email;

        $update = array(
            'hasil_kompetensi' => $request->get('hasil_kompetensi'),
        );

        DB::connection('mandira')
            ->table('pelatihan_pesertas')
            ->where('sesi_pelatihans_id', $request->get('sesi_pelatihans_id'))
            ->where('email_peserta', $email)
            ->update($update);
        //
        $data = DB::connection('mandira')
            ->table('pelatihan_pesertas')
            ->where('sesi_pelatihans_id', $request->get('sesi_pelatihans_id'))
            ->where('email_peserta', $email)
            ->get();
        //
        // return $data;
        return redirect()->back()->with('success', 'Berhasil Mengupdate');
    }


    public function getDetail(Request $request)
    {
        $data = explode(",", $request->id);
        // return $data;
        $pelatihan = PelatihanPeserta::where('sesi_pelatihans_id', $data[0])
            ->where('email_peserta', $data[1])
            ->get();

        $catatan = $pelatihan->rekom_catatan;
        $nilai_TPA = $pelatihan->rekom_nilai_TPA;
        // $keptu
        return response()->json(array(
            'status' => 'oke',
            'data' => $catatan
        ), 200);
    }
}
