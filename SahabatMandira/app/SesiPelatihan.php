<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SesiPelatihan extends Model
{
    protected $table='sesi_pelatihans';
    protected $connection='mandira'; //koneksi apababila tabel berada pada database yang berbeda

    public function paketprogram()
    {
        return $this->setConnection('mysql')->belongsTo('App\PaketProgram','paket_program_id','id');
    }

    public function statuspelatihanpeserta()
    {
        return $this->hasMany('App\StatusPelatihanPeserta','sesi_pelatihans_id','id');
    }

    public function pelatihanpeserta()
    {
        return $this->hasMany('App\PelatihanPeserta','sesi_pelatihans_id','id');
    }

    public function pelatihanmentor()
    {
        return $this->hasMany('App\PelatihanMentor','sesi_pelatihans_id','id');
    }

    public $timestamps=false;

}
