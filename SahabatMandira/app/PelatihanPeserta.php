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
        return $this->belongsTo('App\SesiPelatihan','id','sesi_pelatihans_id');
    }

    protected $primaryKey = ['sesi_pelatihans_id','email_peserta'];

    // protected function setKeysForSaveQuery(Builder $query)
    // {
    //     return $query->where('sesi_pelatihans_id', $this->getAttribute('sesi_pelatihans_id'))
    //         ->where('email_peserta', $this->getAttribute('email_peserta'));
    // }

    public $timestamps = false;
}
