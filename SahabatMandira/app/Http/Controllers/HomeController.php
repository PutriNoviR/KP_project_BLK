<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        $data = $request->session()->get('kelengkapanData');
       
        return view('welcome', compact('data'));
       
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
