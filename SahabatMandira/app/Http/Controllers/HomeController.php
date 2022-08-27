<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SesiPelatihan;

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

        $ditawarkan = SesiPelatihan::all()->Where('tanggal_tutup', '<=', 'CURDATE()');
        // dd($ditawarkan);
        $disarankan = SesiPelatihan::join('status_pelatihan_pesertas as P', 'sesi_pelatihans.id', '=', 'P.sesi_pelatihans_id')
        ->WHERE('P.is_sesuai_minat', '=', '1' )
        ->get();
        return view('dashboard',compact('ditawarkan','disarankan'));

        // return view('dashboard');
    }
}
