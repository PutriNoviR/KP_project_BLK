<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kejuruan extends Model
{
    protected $table='kejuruans';
    public function subkejuruan()
    {
        return $this->hasMany('App\Subkejuruan','kejuruans_id','id');
    }

    public function paketprogram()
    {
        return $this->hasMany('App\PaketProgram','kejuruans_id','id');
    }
}
