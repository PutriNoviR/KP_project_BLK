<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KlasterPsikometrik extends Model
{
    //
    protected $table='klaster_psikometrik';
    public function subkejuruan()
    {
        return $this->hasMany('App\Subkejuruan','kode_klaster','id');
    }
}
