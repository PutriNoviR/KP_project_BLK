<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Lowongan extends Model
{
    //
    public $connection = "mandira";
    public function perusahaan()
    {
        return $this->belongsTo('App\Perusahaan','perusahaans_id','id');
    }

    public function lamaran()
    {
        return $this->hasMany('App\Lamaran', 'lowongans_id');
    }

    public function dokumenlowongan()
    {
        return $this->hasMany(DokumenLowongan::class,'lowongans_id');
    }
    public function pencaker()
    {
        return $this->hasMany(pencaker::class,'lowongans_id','id');
    }
    public function bidang_kerja(){
        
        return $this->belongsTo('App\bidang_kerja' , 'bidang_kerja_id');
    }
}
