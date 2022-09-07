<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DokumenLamaran extends Model
{
    //
    public $connection = "mandira";
    public $timestamps = false;
    protected $table = 'dokumen_lamarans';  
    public function dokumenlowongan()
    {
        return $this->belongsTo(DokumenLowongan::class,'dokumen_lowongans_id');
    }

}
