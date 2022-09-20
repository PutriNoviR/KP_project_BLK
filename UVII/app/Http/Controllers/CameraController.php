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
        $namaDepan = Auth::user()->nama_depan.' '.Auth::user()->nama_belakang;
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
        $namaDepan = Auth::user()->nama_depan.' '.Auth::user()->nama_belakang;
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

    function validatePeserta (Request $request){
        try {
            $id = $request->get('id');
            $val = $request->get('val');
            DB::connection('uvii')->table('uji_minat_awals as um')->where('id',$id)->update(['is_validate'=>$val,'validate_at'=>date("Y-m-d H:i:s"), 'validate_by'=>Auth::user()->email]);
            return response()->json(array(
                'info'=>'selamat peserta berhasil di validasi',
                'resCode'=> '200'
            ),200);
        } catch (\PDOException $e) {
            //throw $th;
            return response()->json(array(
                'info'=>'maaf terjadi kesalahan dengan server, silahkan mencoba kembali',
                'resCode'=> '500'
            ),200);
        }

    }

    function adminValidate(){

        $role_user = Auth::user()->roles_id;
        $menu_role = DB::table('menu_manajemens_has_roles as mmhs')
                    ->join('menu_manajemens as mm','mmhs.menu_manajemens_id','=','mm.id')
                    ->select('mm.nama', 'mm.url')
                    ->where('roles_id', $role_user)
                    ->where('mm.status','Aktif')
                    ->get();

        $arr_data = [];
        $data_akhir = [];

        // $data = DB::connection('masterblk_db')->table('users')
        $riwayat_tes= DB::connection('uvii')->table('uji_minat_awals as um')
            ->select('um.users_email','um.tanggal_mulai','um.tanggal_selesai','um.is_validate','um.klaster_id', 'um.id')
            //->groupBy('um.users_email')
            ->orderBy('um.tanggal_selesai','DESC')
            ->get();

            foreach($riwayat_tes as $sesi){
                $dataUser = DB::connection('mysql')->table('users as us')
                        ->select('us.nama_depan','us.nama_belakang')
                        ->where('us.email',$sesi->users_email)
                        ->first();

                $dataKlaster = DB::connection('mysql')->table('klaster_psikometrik as kp')
                        ->select('kp.nama')
                        ->where('kp.id',$sesi->klaster_id)
                        ->first();
                        
                $arr_data = [
                    'users_email'=>$sesi->users_email,
                    'tanggal_mulai'=>$sesi->tanggal_mulai,
                    'tanggal_selesai'=>$sesi->tanggal_selesai,
                    'is_validate'=>$sesi->is_validate,
                    'id'=>$sesi->id,
                    'nama_depan'=>$dataUser->nama_depan,
                    'nama_belakang'=>$dataUser->nama_belakang,
                    'nama'=>$dataKlaster->nama,
                ];
               array_push($data_akhir, $arr_data);
               
            } 

        $settingValidasi = DB::connection('uvii')->table('settings')->where('id',4)->get();

        // dd($riwayat_tes);
        return view('validatePeserta.index', compact('data_akhir','menu_role','settingValidasi'));
    }

    function validateSetting(Request $request){
        try {
            $val = $request->get('val');
            if($val == 0){
                $newVal = 1;
            }
            else{
                $newVal = 0;
            }

            DB::connection('uvii')->table('settings')->where('id','4')->update(['value'=>$newVal]);
            return response()->json(array(
                'info'=>'Berhasil mengubah pengaturan validasi',
                'val'=> $newVal,
                'resCode'=> '200'
            ),200);
        } catch (\PDOException $e) {
            return response()->json(array(
                'info'=>'maaf terjadi kesalahan dengan server, silahkan mencoba kembali',
                'resCode'=> '500'
            ),200);
        }

    }

}
