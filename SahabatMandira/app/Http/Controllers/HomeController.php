<?php

namespace App\Http\Controllers;

use App\Keahlian;
use App\KeahlianUser;
use App\Lamaran;
use App\MandiraMentoring;
use App\MinatUser;
use App\PelatihanMentor;
use Illuminate\Http\Request;
use App\SesiPelatihan;
use App\User;
use App\PelatihanOther;
use App\PelatihanPeserta;
use App\PelatihanVendor;
use App\Perusahaan;
use App\Role;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        // carousel data-start
        // DB::connection("mandira")->statement(DB::raw("SET @mentor = 'mentor', @blk = 'blk', @vend = 'vend'"));

        $slidervendor = DB::connection("mandira")
                        ->select("select id, nama, deskripsi, gambar, pelatihan_vendor.link, headline_priority from pelatihan_vendor where is_headline=1");

        $sliderblk = DB::connection("mandira")
                        ->select("select sesi_pelatihans.id, sk.nama as nama, deskripsi,sesi_pelatihans.gambar_pelatihan AS gambar,sesi_pelatihans.lokasi AS link, headline_priority from sesi_pelatihans inner join masterblk_db.paket_program AS pp on sesi_pelatihans.paket_program_id = pp.id INNER JOIN masterblk_db.sub_kejuruans as sk ON sk.id = pp.sub_kejuruans_id where is_headline=1 AND is_delete=0");

        $slidermentor = DB::connection("mandira")
                        ->select("select id_mentoring AS id, nama_program AS nama, deskripsi_program AS deskripsi, gambar, mandira_mentorings.link_pendaftaran AS link, headline_priority from mandira_mentorings where is_headline=1");

        // $pencaker = Lamaran::distinct('users_email')->count('users_email');
        $pencaker = User::where('roles_id', 1)->where('is_suspend','<>',1)->distinct('email')->count('email');
        $mitra = Perusahaan::count('nama');
        $idmentor = Role::where('nama_role', 'mentor')->first();
        $mentor = User::where('roles_id', $idmentor->id)->distinct('email')->count('email');
        // $totalpelatihan = SesiPelatihan::where('tanggal_pendaftaran', '<=', date('y-m-d h:i:s', strtotime('now')))->where('tanggal_tutup', '>=', date('y-m-d h:i:s', strtotime('now')))->count();
        $totalpelatihan = SesiPelatihan::count() + PelatihanVendor::count() + PelatihanMentor::count();
        $totalpendaftar = PelatihanPeserta::all()->count();
        $pesertaditerima = PelatihanPeserta::where('rekom_keputusan', 'LULUS')->count();
        $persentase = $pesertaditerima / $totalpendaftar * 100;

        return view('welcome', compact('pencaker', 'mitra', 'mentor', 'totalpelatihan', 'persentase', 'slidermentor', 'sliderblk', 'slidervendor'));
    }

    public function dashboard()
    {
        $userLogin = auth()->user()->email;
        $mytime = Carbon::now();
        $ditawarkan = SesiPelatihan::Where('tanggal_tutup', '>=', $mytime)
            ->skip(0)
            ->take(4)
            ->where('sesi_pelatihans.is_delete',0)
            ->get();
        // dd($ditawarkan);
        // $disarankan = PelatihanPeserta::join('sesi_pelatihans as P', 'pelatihan_pesertas.sesi_pelatihans_id', '=', 'P.id')
        // ->join('masterblk_db.users as u', 'u.email', '=', $userLogin)
        // ->WHERE('pelatihan_pesertas.is_sesuai_minat', '=', '1' )
        // ->get();

        $disarankan = SesiPelatihan::JOIN('masterblk_db.paket_program as pp', 'sesi_pelatihans.paket_program_id', '=', 'pp.id')
            ->JOIN('masterblk_db.sub_kejuruans as sk', 'pp.sub_kejuruans_id', '=', 'sk.id')
            ->JOIN('masterblk_db.kategori_psikometrik as kp', 'kp.id', '=', 'sk.kode_kategori')
            ->JOIN('masterblk_db.minat_user as mu', 'mu.kategori_psikometrik_id', '=', 'kp.id')
            ->WHERE('mu.users_email', '=', $userLogin)
            ->WHERE('tanggal_tutup', '>=', $mytime)
            ->where('sesi_pelatihans.is_delete',0)
            ->select('sesi_pelatihans.*')
            // ->WHERE('p.email_peserta', '=', $userLogin)
            ->skip(0)
            ->take(4)
            ->get();
        // dd($disarankan);

        $checkMinat = MinatUser::WHERE('users_email', '=', $userLogin)->count();

        $adminBlk = auth()->user()->blks_id_admin;
        $blk = DB::table('blks')->select('nama')->where('id',$adminBlk)->get();

        if (auth()->user()->role->nama_role == 'adminblk') {
            $adminDashboard = SesiPelatihan::JOIN('masterblk_db.paket_program as p', 'sesi_pelatihans.paket_program_id', '=', 'p.id')
                ->JOIN('masterblk_db.blks as b', 'p.blks_id', '=', 'b.id')
                ->WHERE('b.id', '=', $adminBlk)
                ->Where('tanggal_tutup', '>=', $mytime)
                ->where('sesi_pelatihans.is_delete',0)
                ->select('sesi_pelatihans.*')
                ->get();

                //dd($adminDashboard);
        } else {
            $adminDashboard = SesiPelatihan::where('sesi_pelatihans.is_delete',0)->get();
            // dd($adminDashboard);
        }


        $mentoring = MandiraMentoring::where('email_mentor', '=', $userLogin)->get();
        // dd($mentoring);

        $programMentor = MandiraMentoring::where('is_validated', '=', 1)
            ->Where('tgl_ditutup', '>=', $mytime)
            ->orderBy('id_mentoring','DESC')
            ->skip(0)
            ->take(4)
            ->get();

        $other = PelatihanVendor::all()
            ->skip(0)
            ->take(4);

        $keahlian = KeahlianUser::where('users_email', '=', $userLogin)->get();

        $daftarKeahlian = Keahlian::JOIN('keahlian_users as k', 'k.keahlians_idkeahlians', '=', 'keahlians.idkeahlians')
            ->where('users_email', '=', $userLogin)->get();
        // dd($keahlian);
        $user = User::join('roles as R', 'users.roles_id', '=', 'R.id')
            ->WHERE('R.nama_role', '=', 'verifikator')
            ->get();

        $dataInstruktur = SesiPelatihan::join('pelatihan_mentors as P', 'sesi_pelatihans.id', '=', 'P.sesi_pelatihans_id')
            ->WHERE('P.mentors_email', '=', $userLogin)
            ->where('sesi_pelatihans.is_delete',0)
            ->get();

        $suspend = auth()->user()->is_suspend;

        $pesertaDiterima = PelatihanPeserta::Where('status_fase', 'DITERIMA')->get();
        // dd($suspend);

        $checkStatusPeserta = PelatihanPeserta::Where('status_fase', 'DALAM SELEKSI')
        ->Where('status_fase', 'CADANGAN')
        ->count();
        // $pelatihans = PelatihanMentor::where('mentors_email','kiky3@gmail.com')->get();
        // $sesi = SesiPelatihan::where('id',$pelatihans[0]->sesi_pelatihans_id)->first();
        // dd($checkStatusPeserta);

        return view('dashboard', compact('ditawarkan', 'disarankan', 'adminDashboard', 'user', 'other', 'keahlian', 'mentoring', 'daftarKeahlian', 'programMentor', 'suspend', 'dataInstruktur','blk','pesertaDiterima','checkMinat','checkStatusPeserta'));

        // return view('dashboard');
    }
}
