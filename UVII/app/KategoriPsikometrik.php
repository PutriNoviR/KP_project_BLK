<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KategoriPsikometrik extends Model
{
    protected $connection = 'mysql';

    protected $table = "kategori_psikometrik";
    public $timestamps= false;

    public function hasilRekomAkhir(){
        return $this->belongsToMany('App\UjiMinatAwal', 'uvii_db.hasil_rekomendasi_tes_tahap_2','kategori_id','uji_minat_awals_id')
            ->withPivot('peringkat','tanggal_mulai','tanggal_selesai','score');
    }
    public function getNama(){
        return $this->belongsTo('App\KlasterPsikometrik', 'klaster_psikometrik_id','id');
    }
}
