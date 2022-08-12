<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subkejuruan extends Model
{
    protected $table='sub_kejuruans';
    public function kejuruan()
    {
        $this->belongsTo('App/Subkejuruan','kejuruans_id','id');
    }

    public function paketprogram()
    {
        return $this->hasMany('App/PaketProgram','subkejuruans_id','idsub_kejuruans');
    }
}
