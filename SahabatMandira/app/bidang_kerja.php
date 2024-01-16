<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bidang_kerja extends Model
{
    //
    public $connection = "mandira";
    protected $table = 'bidang_kerja';
    public $timestamps = false;

    public function lowongan(){
        return $this->hasMany('App\Lowongan' , 'bidang_kerja_id' , 'id');
    }
}
