<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KlasterPsikometrik extends Model
{
    protected $connection = 'mysql';
    protected $table='klaster_psikometrik';
    public $timestamps= false;

    public function ujiMinatAwals(){
        return $this->hasMany('App\UjiMinatAwal','klaster_id','id');
    } 
    public function getKlaster(){
        return $this->hasMany('App\KategoriPsikometrik','klaster_psikometrik_id','id');
    }
}
