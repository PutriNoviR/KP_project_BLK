<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SesiPelatihan;
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
        return view('dashboard',compact('ditawarkan','disarankan'));

        // return view('dashboard');
    }
}
