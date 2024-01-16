<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DokumenPerusahaan extends Model
{
    //
    protected $table = 'dokumen_perusahaans';
    public $connection = "mandira";
    public $timestamps = false;

    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class,'perusahaans_id');
    }
}
