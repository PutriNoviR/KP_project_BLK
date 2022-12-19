<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jawaban;
use App\Pertanyaan;
use Illuminate\Support\Facades\Auth;
use App\UjiMinatAwal;
use Illuminate\Support\Facades\DB;
use App\KlasterPsikometrik;
use App\User;
use App\Role;

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
        $tes = UjiMinatAwal::where('users_email', $email)->where(function($query){
                    $query->where('tanggal_selesai', null)->orWhere('klaster_id',0);
                })->first();
       // $data = $request->session()->get('kelengkapanData');

       //--menu manajemen--
       $role_user = Auth::user()->roles_id;
       $menu_role = DB::table('menu_manajemens_has_roles as mmhs')
                   ->join('menu_manajemens as mm','mmhs.menu_manajemens_id','=','mm.id')
                   ->select('mm.nama', 'mm.url')
                   ->where('roles_id', $role_user)
                   ->where('mm.status','Aktif')
                   ->get();

        $riwayat_tes= UjiMInatAwal::where(DB::raw("(DATE_FORMAT(tanggal_mulai,'%Y-%m-%d'))"),'>=','2022-11-02')->get();

        
        $dataKlaster = KlasterPsikometrik::all();
        $dataKategori = UjiMinatAwal::getDataKategoriPsikometrik($riwayat_tes);

        $idRole = Role::where('nama_role', 'peserta')->first();
        $user =User::where('roles_id',$idRole->id)->get();

        $hasil_final = User::hasilTesSemuaPeserta($user, $riwayat_tes, $dataKlaster, $dataKategori);
     
        $riwayatTes1 = UjiMinatAwal::where('users_email',$email)
                        ->where('klaster_id','!=',0)
                        ->orderBy('tanggal_selesai','DESC')
                        ->first();

        $riwayatTes2 = DB::table('minat_user as mu')
                ->join('kategori_psikometrik as kp','kp.id','=','mu.kategori_psikometrik_id')
                ->select('kp.nama as nama_klaster')
                ->where('users_email', $email)
                ->where('kp.id', '!=',0)
                ->orderBy('peringkat','ASC')
                ->get();

        $lanjutTesTahap2 = DB::connection('uvii')->table('hasil_rekomendasi_tes_tahap_2')
                ->where('uji_minat_awals_id',($riwayatTes1->id??''))
                ->get();

        if($riwayatTes1){
            $linkTes2 = KlasterPsikometrik::where('id', $riwayatTes1->klaster_id)
                    ->first();
            $linkTes2 = $linkTes2->link_kejuruan_tes_2;
        }
        else{
            $linkTes2 = '#';
        }
        $settingValidasi = DB::connection('uvii')->table('settings')->where('id',4)->get();

        return view('welcome', compact('tes','menu_role', 'riwayatTes1', 'riwayatTes2', 'linkTes2', 'lanjutTesTahap2','settingValidasi','hasil_final'));
    }

    public function search(Request $request){
        $keyword = $request->keyword;
        $role_user = Auth::user()->role->id;

        if($keyword){
            $menu = DB::table('menu_manajemens as mm')
                        ->join('menu_manajemens_has_roles as mmhs','mmhs.menu_manajemens_id','=','mm.id')
                        ->where('mmhs.roles_id',$role_user)
                        ->where('mm.nama','like', '%'.$keyword.'%')
                        ->orWhere('mm.deskripsi','like','%'.$keyword.'%')
                        ->first() ?? null;

            if($menu != null){
                
                return redirect()->route($menu->url);
            }
            else{
                return redirect()->back()->with('error','menu tidak ditemukan');
            }
       
        }
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
