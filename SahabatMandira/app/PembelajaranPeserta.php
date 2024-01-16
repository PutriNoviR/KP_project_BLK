<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PembelajaranPeserta extends Model
{
    //

    protected $table = 'pelajaran_mentor_persesi'; //nma table
    protected $connection='mandira';

    public $timestamps=false;
}
