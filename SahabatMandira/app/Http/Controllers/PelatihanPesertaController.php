<?php

namespace App\Http\Controllers;

use App\MinatUser;
use App\PaketProgram;
use App\PelatihanPeserta;
use App\SesiPelatihan;
use App\User;
use Auth;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class PelatihanPesertaController extends Controller
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
        //ambil data siapa yang login
        $userLogin = auth()->user()->email;
        //ambil sesi pelatihan
        $periode = SesiPelatihan::find($id);
        // $pelatihan = ::find($id);
        //ambil data user dan pelatihan peserta
        $p = 1;
        $data = DB::connection('mandira')
            ->table('pelatihan_pesertas as pp')
            ->join('masterblk_db.users as u', 'pp.email_peserta', '=', 'u.email')
            ->where('sesi_pelatihans_id', $id)
            ->get();
        $id_sesi = $id;

        
        $checkStatusPeserta = PelatihanPeserta::Where('status_fase', 'DALAM SELEKSI')
        ->Where('status_fase', 'CADANGAN')
        ->count();
        
        return view('pelatihanpeserta.index', compact('data', 'periode', 'id_sesi','p','checkStatusPeserta'));
    }

    public function showPesertas($id)
    {
        //ambil data siapa yang login
        $userLogin = auth()->user()->email;
        //ambil sesi pelatihan
        $periode = SesiPelatihan::find($id);
        // $pelatihan = ::find($id);
        //ambil data user dan pelatihan peserta
        $p = 0;
        $data = DB::connection('mandira')
            ->table('pelatihan_pesertas as pp')
            ->join('masterblk_db.users as u', 'pp.email_peserta', '=', 'u.email')
            ->where('sesi_pelatihans_id', $id)
            ->where('status_fase','DITERIMA')
            ->get();
        $id_sesi = $id;
        return view('pelatihanpeserta.index', compact('data', 'periode', 'id_sesi', 'p'));
    }

    public function showPesertaDiterima()
    {
        //ambil data siapa yang login
        $userLogin = auth()->user()->email;
        // $pelatihan = ::find($id);
        //ambil data user dan pelatihan peserta
        $data = DB::connection('mandira')
            ->table('pelatihan_pesertas as pp')
            ->join('masterblk_db.users as u', 'pp.email_peserta', '=', 'u.email')
            ->join('sesi_pelatihans as sp', 'sp.id','=','pp.sesi_pelatihans_id')
            ->join('masterblk_db.paket_program as pk', 'pk.id', '=', 'sp.paket_program_id')
            ->join('masterblk_db.blks as b', 'b.id', '=', 'pk.blks_id')
            ->join('masterblk_db.sub_kejuruans as sk', 'sk.id', '=', 'pk.sub_kejuruans_id')
            ->where('status_fase','DITERIMA')
            ->selectRaw('u.email as email, u.username as username, CONCAT(u.nama_depan," ",u.nama_belakang) AS nama, pp.status_fase as status, b.nama as blk, sk.nama as sub_kejuruan')
            ->get();
        // dd($data);

        return view('instruktur.index', compact('data'));
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
            ->where('id', $idSesiPelatihan)->value('kuota');

        $tgl_mulai_pelatihan = DB::connection('mandira')
            ->table('sesi_pelatihans')
            ->where('id', $idSesiPelatihan)->value('tanggal_mulai_pelatihan');
        

        $flag = 0;

        $cadangan = 0;
        // flag  0 -> normal
        // flag = 1 -> melebihi kuota
        // flag = 2 -> tanggal sekarang melampaui tgl mulai pelatihan

        // dd('1');
        if ($request->get('rekom_keputusan') == 'LULUS') {
            if ($countDiterima < $kuota) {
                $update = array(
                    'rekom_catatan' => $request->get('rekom_catatan'),
                    'rekom_nilai_TPA' => $request->get('rekom_nilai_TPA'),
                    'rekom_keputusan' => $request->get('rekom_keputusan'),
                    'rekom_is_permanent' => $request->get('rekom_is_permanent'),
                    'status_fase' => 'DITERIMA',
                );
            } else {
                $flag = 1;
            }
        } elseif (($request->get('rekom_keputusan') == 'TIDAK LULUS') || ($request->get('rekom_keputusan') == 'MENGUNDURKAN DIRI')) {
            $update = array(
                'rekom_catatan' => $request->get('rekom_catatan'),
                'rekom_nilai_TPA' => $request->get('rekom_nilai_TPA'),
                'rekom_keputusan' => $request->get('rekom_keputusan'),
                'rekom_is_permanent' => $request->get('rekom_is_permanent'),
                'status_fase' => 'DITOLAK',
            );
        } elseif (($request->get('rekom_keputusan') == 'CADANGAN')) {
            
            $jumlahCadangan = PelatihanPeserta::where('sesi_pelatihans_id', $idSesiPelatihan)
            ->where('rekom_keputusan', '=', 'CADANGAN')
            ->count();

            if($jumlahCadangan > 3){
                $cadangan = 1;
            }
            else {
                
                $update = array(
                    'rekom_catatan' => $request->get('rekom_catatan'),
                    'rekom_nilai_TPA' => $request->get('rekom_nilai_TPA'),
                    'rekom_keputusan' => $request->get('rekom_keputusan'),
                    'rekom_is_permanent' => $request->get('rekom_is_permanent'),
                    'status_fase' => 'PESERTA CADANGAN',
                );
    
            }

        }

        if (strtotime($tgl_mulai_pelatihan) <= strtotime('now')) {
            $flag = 2;
        }

        if ($flag == 1) {
            return redirect()->back()->with('failed', 'Gagal Update! Jumlah diterima sudah max kuota!');
        } elseif ($flag == 2) {
            return redirect()->back()->with('failed', 'Tidak Dapat Mengundurkan Diri Setelah Periode Pelatihan Dimulai');
            //bisa juga disuspend/blacklist
        } else {

            if($cadangan == 1) {

                return redirect()->back()->with('failed', 'Gagal Mengupdate karena Jumlah Cadangan Max!');

            } else {

                DB::connection('mandira')
                ->table('pelatihan_pesertas')
                ->where('sesi_pelatihans_id', $request->get('sesi_pelatihans_id'))
                ->where('email_peserta', $email)
                ->update($update);
                    
                return redirect()->back()->with('success', 'Berhasil Mengupdate');
            }
            
        }
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
            ->JOIN('sesi_pelatihans as s', 'pp.sesi_pelatihans_id', 's.id')
            ->where('email_peserta', $email)
            ->where('sesi_pelatihans_id', $id)
            ->SELECT('pp.*', 's.tanggal_seleksi as tgl_seleksi')
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
        //mengambil email user yang login
        $userLogin = auth()->user()->email;

        //count orang yang daftar dan kuota pendaftar
        $cnt_daftar = DB::connection('mandira')
            ->table('sesi_pelatihans as s')
            ->LEFTJOIN('pelatihan_pesertas as p', 's.id', 'p.sesi_pelatihans_id')
            ->where('s.id', $id)
            ->selectRaw("IFNULL(COUNT(p.email_peserta),0) as pendaftar, s.kuota_daftar")
            ->GROUPBY('s.kuota_daftar')
            ->first();

        $pernah_tes_minat = MinatUser::WHERE('users_email', $userLogin)
            ->count();

        $cek_minat = PaketProgram::JOIN('mandira_db.sesi_pelatihans AS s', 's.paket_program_id', 'paket_program.id')
            ->JOIN('sub_kejuruans AS sk', 'paket_program.sub_kejuruans_id', 'sk.id')
            ->JOIN('kategori_psikometrik AS kp', 'sk.kode_kategori', 'kp.id')
            ->JOIN('minat_user AS m', 'm.kategori_psikometrik_id', 'kp.id')
            ->WHERE('m.users_email', $userLogin)
            ->WHERE('s.id', $id)
            ->SELECTRAW('IFNULL(COUNT(m.kategori_psikometrik_id),0) AS cek')
            ->value('cek');

        $cekdaftartahunan = PelatihanPeserta::JOIN('sesi_pelatihans as s', 'pelatihan_pesertas.sesi_pelatihans_id', 's.id')
            ->whereRaw("pelatihan_pesertas.email_peserta = '$userLogin' AND YEAR(s.tanggal_tutup) = YEAR(CURDATE())
            AND pelatihan_pesertas.rekom_keputusan IN ('LULUS', 'CADANGAN', 'MENGUNDURKAN DIRI')")
            ->count();

        $cekDaftar = PelatihanPeserta::where('sesi_pelatihans_id', '=', $id)
            ->where('email_peserta', '=', $userLogin)
            ->count();

        $cekDaftarLain = PelatihanPeserta::where('email_peserta', '=', $userLogin)
            ->count();

        $cekseleksiaktif = PelatihanPeserta::JOIN('sesi_pelatihans as s', 'pelatihan_pesertas.sesi_pelatihans_id', 's.id')
            ->whereRaw("pelatihan_pesertas.email_peserta = '$userLogin' AND (YEAR(s.tanggal_mulai_pelatihan) = YEAR(CURDATE()) 
            AND s.tanggal_mulai_pelatihan > CURDATE()) AND pelatihan_pesertas.status_fase = 'DALAM SELEKSI'")
            ->count();

        if ($cekdaftartahunan > 0) {
            return redirect()->back()->with('error', 'Anda pernah mengikuti/menyelesaikan/mengundurkan diri dari pelatihan pada tahun yang sama. Silahkan anda join pada pelatihan tahun mendatang !');
        } elseif ($cekseleksiaktif > 0) {
            if ($cekDaftar > 0) {
                return redirect()->back()->with('error', 'Anda sudah terdaftar pada pelatihan ini. Silahkan ikuti prosedur untuk menyelesaikan proses seleksi !');
            } else {
                //
                return redirect()->back()->with('error', 'Anda sedang dalam proses seleksi sebuah pelatihan. Mohon selesaikan seleksi terlebih dahulu !');
            }
        } elseif ($cekDaftarLain > 0){
            return redirect()->back()->with('error', 'Anda sedang dalam proses seleksi sebuah pelatihan. Mohon selesaikan seleksi terlebih dahulu !');
        }
        else {

            if ($cnt_daftar->pendaftar >= $cnt_daftar->kuota_daftar) {
                return redirect()->back()->with('error', 'Mohon maaf, jumlah pendaftar untuk sesi pelatihan ini telah mencapai batas kuota !');
            } else {

                //mengambil data instruktur yang melakukan input
                $emailValidator = DB::connection('mandira')
                    ->table('pelatihan_mentors')
                    ->where('sesi_pelatihans_id', $id)
                    ->value('mentors_email');

                $emailUser = auth()->user()->email;
                // dd($emailValidator);

                if ($pernah_tes_minat > 0) {
                    if ($cek_minat > 0) {

                        //masukkan ke peserta yang mendaftar
                        $insert = array(
                            'email_peserta' => $emailUser,
                            'sesi_pelatihans_id' => $id,
                            'tanggal_seleksi' => $request->get('tanggal_seleksi'),
                            'rekom_validator' => $emailValidator,
                            'is_sesuai_minat' => '1' // sesuai minat
                        );
                    } else {
                        //masukkan ke peserta yang mendaftar
                        $insert = array(
                            'email_peserta' => $emailUser,
                            'sesi_pelatihans_id' => $id,
                            'tanggal_seleksi' => $request->get('tanggal_seleksi'),
                            'rekom_validator' => $emailValidator,
                            'is_sesuai_minat' => '-1' //tidak sesuai minat
                        );
                    }
                } else {
                    //masukkan ke peserta yang mendaftar
                    $insert = array(
                        'email_peserta' => $emailUser,
                        'sesi_pelatihans_id' => $id,
                        'tanggal_seleksi' => $request->get('tanggal_seleksi'),
                        'rekom_validator' => $emailValidator,
                        'is_sesuai_minat' => '0' //tidak mengikuti tes
                    );
                }

                //masukkan data ke dalam tabel
                DB::connection('mandira')
                    ->table('pelatihan_pesertas')
                    ->insert($insert);

                //
                $data = DB::connection('mandira')
                    ->table('pelatihan_pesertas as pp')
                    ->join('sesi_pelatihans as s', 'pp.sesi_pelatihans_id', '=', 's.id')
                    ->join('masterblk_db.users as u', 'pp.email_peserta', '=', 'u.email')
                    ->join('masterblk_db.paket_program as pr', 'pr.id', '=', 's.paket_program_id')
                    ->join('masterblk_db.blks as b', 'pr.blks_id', 'b.id')
                    ->join('masterblk_db.sub_kejuruans as sk', 'pr.sub_kejuruans_id', 'sk.id')
                    ->join('masterblk_db.kejuruans as k', 'pr.kejuruans_id', 'k.id')
                    ->where('s.id', $id)
                    ->where('u.email', $emailUser)
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

    public function updateSeleksiMasal(Request $request)
    {
        $emails = $request->emails;
        $sesi_id = $request->sesi_id;

        $sesi = SesiPelatihan::find($sesi_id);
        if (strtotime('now') >= strtotime($sesi->tanggal_mulai_pelatihan)) {
            return response()->json(array(
                'status' => 'err'
            ), 200);
        } else {
            //
            foreach ($emails as $e) {
                DB::connection('mandira')
                    ->table('pelatihan_pesertas')
                    ->where('email_peserta', $e)
                    ->where('sesi_pelatihans_id', $sesi_id)
                    ->update(['rekom_keputusan' => 'LULUS', 'status_fase' => 'DITERIMA']);
            }

            return response()->json(array(
                'status' => 'oke'
            ), 200);
        }
    }

    public function updateNilaiAkhir(Request $request)
    {
        $idSesiPelatihan = $request->get('id');
        $email = $request->get('email_peserta');

        $jumlahCadangan = PelatihanPeserta::where('sesi_pelatihans_id', $idSesiPelatihan)
        ->where('rekom_keputusan', '=', 'CADANGAN')
        ->count();
        
        
        if($jumlahCadangan > 3){
            return redirect()->back()->with('failed', 'Gagal Update! Jumlah cadangan sudah max kuota!');
        }
        else {
            PelatihanPeserta::where('sesi_pelatihans_id', $idSesiPelatihan)
                ->where('email_peserta', $email)
                ->update(['nilai_akhir'=>$request->nilaiAkhir]);
            
            return redirect()->back()->with('success', 'Data nilai akhir berhasil di update !');
        }
    }

}
