<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    //
    protected $table='tugas';
    protected $connection='mandira';

    public $timestamps=false;
}
