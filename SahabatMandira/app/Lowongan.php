<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lowongan extends Model
{
    //
    public function perusahaan()
    {
        return $this->hasMany('App\Perusahaan','perusahaans_id','id');
    }
}
