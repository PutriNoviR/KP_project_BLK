<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\UjiMinatAwal;
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

       //--menu manajemen--
       $role_user = Auth::user()->roles_id;
       $menu_role = DB::table('menu_manajemens_has_roles as mmhs')
                   ->join('menu_manajemens as mm','mmhs.menu_manajemens_id','=','mm.id')
                   ->select('mm.nama', 'mm.url')
                   ->where('roles_id', $role_user)
                   ->where('mm.status','Aktif')
                   ->get();
       
        return view('welcome', compact('tes','menu_role'));
       
    }

    public function menuFilter(){
        $role_user = Auth::user()->roles_id;
        $menu_role = DB::table('menu_manajemens_has_roles as mmhs')
                    ->join('menu_manajemens as mm','mmhs.menu_manajemens_id','=','mm.id')
                    ->select('mm.nama', 'mm.url')
                    ->where('roles_id', $role_user)
                    ->where('mm.status','Aktif')
                    ->get();
        return $menu_role;
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
