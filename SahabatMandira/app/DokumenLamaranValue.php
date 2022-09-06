<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DokumenLamaranValue extends Model
{
    //
    protected $table= 'dokumen_lamaran_values';
    public $connection = "mandira";
    public function dokumenlamaran()
    {
        return $this->belongsTo(DokumenLamaran::class,'dokumen_lamarans_id');
    }
}
