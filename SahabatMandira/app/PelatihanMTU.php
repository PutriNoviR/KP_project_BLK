<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PelatihanMTU extends Model
{
    //
    protected $table = 'pelatihan_mtus'; //nma table
    protected $connection='mandira';

    public $timestamps=false;

    protected $primaryKey = 'idpelatihan_mtus';
}
