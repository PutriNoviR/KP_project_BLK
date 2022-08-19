<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KategoriPsikometrik extends Model
{
    //
    protected $table='kategori_psikometrik';
    public function subkejuruan()
    {
        return $this->hasMany('App\Subkejuruan','kode_kategori','id');
    }
}
