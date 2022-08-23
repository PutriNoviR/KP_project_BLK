<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blk extends Model
{
    public function paketprogram()
    {
        return $this->hasMany('App\PaketProgram','blks_id','id');
    }
    public function user()
    {
        return $this->hasMany('App\User','blks_id_admin','id');
    }
}
