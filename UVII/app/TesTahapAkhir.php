<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TesTahapAkhir extends Model
{  
    protected $table = 'minat_user';
    // public function hasilJawabanTes2(){
    //     return $this->belongsTo('App\UjiMinatAwal','kategori_id', 'uji_minat_awals_id');
       
    //}

    public static function getDataJawabanAkhir($idSesi){
        $listJawaban2 = DB::table('minat_user as mu')
                        ->join('kategori_psikometrik as kp','mu.kategori_psikometrik_id','=','kp.id')
                        ->select('kp.nama','mu.peringkat')
                            ->where('users_email', $idSesi)
                            ->where('kp.nama','!=','BELUM_ADA')
                            ->orderBy('peringkat', 'ASC')
                            ->get();

        $tesTahap2 = DB::connection('uvii')->table('hasil_rekomendasi_tes_tahap_2 as hrt')
                        ->select('hrt.tanggal_mulai', 'hrt.tanggal_selesai')
                        ->join('uji_minat_awals as uma', 'uma.id', '=', 'hrt.uji_minat_awals_id')
                        ->where('uma.users_email', $idSesi)
                        ->orderBy('hrt.tanggal_selesai', 'DESC')
                        ->first();
        
         return ["listjawaban"=>$listJawaban2, "testahap2"=>$tesTahap2];
    }
}
