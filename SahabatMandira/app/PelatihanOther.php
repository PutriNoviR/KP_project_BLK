<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PelatihanOther extends Model
{
    //
    protected $table='pelatihan_others';
    protected $connection='mandira';

    public function perusahaan()
    {
        return $this->belongsTo('App\Perusahaan','perusahaans_id','id');
    }
}
