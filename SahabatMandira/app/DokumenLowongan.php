<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DokumenLowongan extends Model
{
    //
    protected $table = 'dokumen_lowongans';
    public $connection = "mandira";
    public $timestamps = false;

    public function lowongan()
    {
        return $this->belongsTo(Lowongan::class,'lowongans_id');
    }

    public function dokumenlamaran()
    {
        return $this->hasMany(DokumenLamaran::class,'dokumen_lowongans_id');
    }
}   
