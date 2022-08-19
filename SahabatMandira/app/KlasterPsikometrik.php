<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KlasterPsikometrik extends Model
{
    //
    
    public function subkejuruan()
    {
        return $this->hasMany('App/Subkejuruan','kode_klaster','id');
    }
}
