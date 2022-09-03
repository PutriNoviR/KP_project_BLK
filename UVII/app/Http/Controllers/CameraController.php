<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Storage;
use DB;


class CameraController extends Controller
{
    function camera(){
        return view('webcam');
    }

    function capture(Request $request){

        $img = $request->get('image');
        $namaDepan = Auth::user()->nama_depan;
        $folderPath = "camera/awal/";

        // dd($img);

        $image_parts = explode(';base64,',$img);
        $image_type_aux = explode('image/', $image_parts[0]);
        $image_type = $image_type_aux[1];

        $image_base64 = base64_decode($image_parts[1]);
        $filename = $namaDepan.'.png';

        $file = $folderPath.$filename;

        file_put_contents($file,$image_base64);

        return response()->json(array(
            'msg' => 'Berhasil'
        ), 200);
    }

    function captureAkhir(Request $request){
        $img = $request->get('image');
        $namaDepan = Auth::user()->nama_depan;
        $folderPath = "camera/akhir/";

        // dd($img);

        $image_parts = explode(';base64,',$img);
        $image_type_aux = explode('image/', $image_parts[0]);
        $image_type = $image_type_aux[1];

        $image_base64 = base64_decode($image_parts[1]);
        $filename = $namaDepan.'.png';

        $file = $folderPath.$filename;

        file_put_contents($file,$image_base64);

        return response()->json(array(
            'msg' => 'Berhasil'
        ), 200);
    }

    function adminValidate(){

        $role_user = Auth::user()->roles_id;
        $menu_role = DB::table('menu_manajemens_has_roles as mmhs')
                    ->join('menu_manajemens as mm','mmhs.menu_manajemens_id','=','mm.id')
                    ->select('mm.nama', 'mm.url')
                    ->where('roles_id', $role_user)
                    ->where('mm.status','Aktif')
                    ->get();
        // $data = DB::connection('masterblk_db')->table('users')
        $riwayat_tes= DB::connection('uvii')->table('uji_minat_awals as um')
            ->select('um.users_email','um.tanggal_mulai','um.tanggal_selesai','kp.nama as rekomendasi_klaster','us.nama_depan')
            ->join('masterblk_db.klaster_psikometrik as kp','um.klaster_id','=','kp.id')
            ->join('masterblk_db.users as us', 'um.users_email','=','us.email')
            //->groupBy('um.users_email')
            ->orderBy('um.tanggal_selesai','DESC')
            ->get();
        return view('validatePeserta.index', compact('riwayat_tes','menu_role'));
    }
}
