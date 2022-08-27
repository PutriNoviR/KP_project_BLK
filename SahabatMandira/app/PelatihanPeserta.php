<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PelatihanPeserta extends Model
{
    //
    protected $table='pelatihan_pesertas';
    protected $connection='mandira'; //koneksi apababila tabel berada pada database yang berbeda
    

    public function user()
    {
        return $this->setConnection('mysql')->belongsTo('App\User','email_peserta','email');
    }

    public function sesipelatihan()
    {
        return $this->belongsTo('App\SesiPelatihan','sesi_pelatihans_id','id');
    }

    public $timestamps = false;
}
