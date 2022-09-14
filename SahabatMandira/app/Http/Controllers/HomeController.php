<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SesiPelatihan;
use App\User;
use App\PelatihanOther;
use App\PelatihanVendor;

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
        return view('welcome');
    }

    public function dashboard()
    {
        $userLogin = auth()->user()->email;
        $ditawarkan = SesiPelatihan::all()->Where('tanggal_tutup', '<=', 'CURDATE()')
        ->skip(0)
        ->take(4);
        // dd($ditawarkan);
        // $disarankan = PelatihanPeserta::join('sesi_pelatihans as P', 'pelatihan_pesertas.sesi_pelatihans_id', '=', 'P.id')
        // ->join('masterblk_db.users as u', 'u.email', '=', $userLogin)
        // ->WHERE('pelatihan_pesertas.is_sesuai_minat', '=', '1' )
        // ->get();

        $disarankan = SesiPelatihan::JOIN('pelatihan_pesertas as p', 'sesi_pelatihans.id', '=', 'p.sesi_pelatihans_id')
        ->JOIN('masterblk_db.paket_program as pp', 'sesi_pelatihans.paket_program_id','=','pp.id')
        ->JOIN('masterblk_db.sub_kejuruans as sk', 'pp.sub_kejuruans_id','=','sk.id')
        ->JOIN('masterblk_db.kategori_psikometrik as kp', 'kp.id','=','sk.kode_kategori')
        ->JOIN('masterblk_db.minat_user as mu', 'mu.kategori_psikometrik_id','=','kp.id')
        ->WHERE('mu.users_email', '=', $userLogin)
        ->WHERE('p.email_peserta', '=', $userLogin)
        ->skip(0)
        ->take(4)
        ->get();
        // dd($disarankan);

        $adminBlk = auth()->user()->blks_id_admin;

        $adminDashboard = SesiPelatihan::JOIN('masterblk_db.paket_program as p', 'sesi_pelatihans.paket_program_id', '=', 'p.id')
        ->JOIN('masterblk_db.blks as b', 'p.blks_id', '=', 'b.id')
        ->WHERE('b.id','=',$adminBlk)
        ->get();

        $other = PelatihanVendor::all()
        ->skip(0)
        ->take(4);


        $user = User::join('roles as R', 'users.roles_id', '=', 'R.id')
        ->WHERE('R.nama_role', '=', 'verifikator' )
        ->get();

        return view('dashboard',compact('ditawarkan','disarankan', 'adminDashboard','user','other'));

        // return view('dashboard');
    }
}
