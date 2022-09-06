<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DokumenLamaran extends Model
{
    //
    public $connection = "mandira";
    protected $table = 'dokumen_lamarans';  
    public function dokumenlowongan()
    {
        return $this->belongsTo(DokumenLowongan::class,'dokumen_lowongans_id');
    }

    public function lamaran()
    {
        return $this->belongsTo(Lamaran::class,['users_email','dokumen_lowongans_id']);
    }

    public function dokumenlamaranvalue()
    {
        return $this->hasMany(DokumenLamaranValue::class,'dokumen_lamarans_id');
    }
}
