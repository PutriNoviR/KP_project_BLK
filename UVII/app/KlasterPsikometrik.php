<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KlasterPsikometrik extends Model
{
    protected $connection = 'mysql';
    protected $table='klaster_psikometrik';

    public function ujiMinatAwals(){
        return $this->hasMany('App\UjiMinatAwal','klaster_id','id');
    } 
}
