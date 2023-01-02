<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PesertaMTU extends Model
{
    //
    protected $table = 'pelatihan_mtu_pesertas'; //nma table
    protected $connection='mandira';

    public $timestamps=false;
}
