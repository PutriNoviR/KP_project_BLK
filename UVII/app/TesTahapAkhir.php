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
             ->orderBy('peringkat', 'ASC')
             ->get();
 
        
         return $listJawaban2;
    }
}
