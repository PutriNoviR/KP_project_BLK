<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SesiPelatihan;
use App\User;
use App\PelatihanPeserta;

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
        $ditawarkan = SesiPelatihan::all()->Where('tanggal_tutup', '<=', 'CURDATE()');
        // dd($ditawarkan);
        // $disarankan = PelatihanPeserta::join('sesi_pelatihans as P', 'pelatihan_pesertas.sesi_pelatihans_id', '=', 'P.id')
        // ->join('masterblk_db.users as u', 'u.email', '=', $userLogin)
        // ->WHERE('pelatihan_pesertas.is_sesuai_minat', '=', '1' )
        // ->get();

        $disarankan = SesiPelatihan::JOIN('pelatihan_pesertas as p', 'sesi_pelatihans.id', '=', 'p.sesi_pelatihans_id')
        ->WHERE('p.email_peserta', '=', $userLogin)
        ->WHERE('p.is_sesuai_minat', '=', '1' )
        ->get();
        // dd($disarankan);

        $adminBlk = auth()->user()->blks_id_admin;

        $adminDashboard = SesiPelatihan::JOIN('masterblk_db.paket_program as p', 'sesi_pelatihans.paket_program_id', '=', 'p.id')
        ->JOIN('masterblk_db.blks as b', 'p.blks_id', '=', 'b.id')
        ->WHERE('b.id','=',$adminBlk)
        ->get();

        
        $user = User::join('roles as R', 'users.roles_id', '=', 'R.id')
        ->WHERE('R.nama_role', '=', 'verifikator' )
        ->get();

        return view('dashboard',compact('ditawarkan','disarankan', 'adminDashboard','user'));

        // return view('dashboard');
    }
}
