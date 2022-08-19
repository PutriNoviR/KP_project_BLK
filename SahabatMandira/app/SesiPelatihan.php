<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SesiPelatihan extends Model
{
    protected $table='sesi_pelatihans';
    public function paketprogram()
    {
        return $this->belongsTo('App\PaketProgram','paket_program_id','id');
    }

    public function statuspelatihanpeserta()
    {
        return $this->hasMany('App/StatusPelatihanPeserta','sesi_pelatihans_id','id');
    }

    public function pelatihanpeserta()
    {
        return $this->hasMany('App/PelatihanPeserta','sesi_pelatihans_id','id');
    }
}
