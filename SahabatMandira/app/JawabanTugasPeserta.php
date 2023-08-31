<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JawabanTugasPeserta extends Model
{
    //
    
    protected $table = 'jawaban_tugas_pesertas'; //nma table
    protected $connection='mandira';

    public $timestamps=true;

    public function user(){
        return $this->belongsTo('App\User','users_email');
    }
}
