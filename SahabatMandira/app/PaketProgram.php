<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaketProgram extends Model
{
    //
    public function blk()
    {
        return $this->belongsTo('App\Blk','blks_id','id');
    }
    public function kejuruan()
    {
        return $this->belongsTo('App\Kejuruan','kejuruans_id','id');
    }
    public function subkejuruan()
    {
        return $this->belongsTo('App\Subkejuruan','subkejuruans_id','id');
    }
}
