<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaketProgram extends Model
{
    protected $table = 'paket_program'; //nma table
    //
    public function blk()
    {
        return $this->belongsTo('App\Blk','blks_id','id'); //one d pket program 
    }
    public function kejuruan()
    {
        return $this->belongsTo('App\Kejuruan','kejuruans_id','id');
    }
    public function subk()
    {
        return $this->belongsTo('App\Subkejuruan','sub_kejuruans_id','id');
    }
}
