<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UjiMinatAwal extends Model
{
    protected $connection = 'uvii';
    protected $table = 'uji_minat_awals';

    public function user(){
        return $this->belongsTo('App\User','users_email');
    }

    public function hasilJawabans(){
        return $this->belongsToMany('App\Pertanyaan','hasil_jawabans','questions_id',
        'uji_minat_awals_id')->withPivot('jawaban');
    }

    public $timestamps = false;
}
