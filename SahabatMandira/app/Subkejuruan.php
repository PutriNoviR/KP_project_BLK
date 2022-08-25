<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subkejuruan extends Model
{
    protected $table='sub_kejuruans';
    public function kejuruan()
    {
        return $this->belongsTo('App\Kejuruan','kejuruans_id','id');
    }

    public function paketprogram()
    {
        return $this->hasMany('App\PaketProgram','sub_kejuruans_id','id');

    }

    public function kategori()
    {
        return $this->belongsTo('App\KategoriPsikometrik','kode_kategori','id');
    }

    public function klaster()
    {
        return $this->belongsTo('App\KlasterPsikometrik','kode_klaster','id');
    }
}
