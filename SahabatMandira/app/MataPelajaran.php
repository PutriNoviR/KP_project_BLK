<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MataPelajaran extends Model
{
    protected $table = 'mata_pelajaran'; //nma table
    protected $connection='mandira';

    public $timestamps=false;
}