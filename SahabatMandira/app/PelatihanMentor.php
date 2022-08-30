<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PelatihanMentor extends Model
{
    //
    protected $table='pelatihan_mentors';
    protected $connection='mandira'; //koneksi apababila tabel berada pada database yang berbeda
  
    public function user()
    {
        return $this->setConnection('mysql')->belongsTo('App\User','mentors_email','email');
    }

    public function sesipelatihan()
    {
        return $this->belongsTo('App\SesiPelatihan','sesi_pelatihans_id','id');
    }

    // protected $primaryKey = ['sesi_pelatihans_id','mentors_email'];

    public $timestamps = false;
}
