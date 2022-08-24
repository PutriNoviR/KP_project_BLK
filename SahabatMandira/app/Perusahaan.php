<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    //
    public function User()
    {
        return $this->hasMany('App\User','verified_by','id');
    }

    public function Lowongan(){
        return $this->belongsTo('App\Lowongan','perusahaans_id');
    }
}
