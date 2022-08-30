<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Lowongan extends Model
{
    //
    public $connection = "mandira";
    public function perusahaan()
    {
        return $this->belongsTo('App\Perusahaan','perusahaans_id','id');
    }
}
