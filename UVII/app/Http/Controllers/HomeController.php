<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\UjiMinatAwal;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {    
        $email = Auth::user()->email;
        $tes = UjiMinatAwal::where('users_email', $email)->where('tanggal_selesai', null)->first();   
       // $data = $request->session()->get('kelengkapanData');
       
        return view('welcome', compact('tes'));
       
    }

    // public function dashboardPage (Request $request)
    // {
    //     $user = $request->user();
    //     if ($user->hasRole('Admin'))
    //     {
    //         return redirect('/admin');
    //     }
    //     else if ($user->hasRole('Peserta'))
    //     {
    //         return redirect('/');
    //     }
    // }
}
