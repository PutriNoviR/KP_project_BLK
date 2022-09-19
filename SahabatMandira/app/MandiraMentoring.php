<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MandiraMentoring extends Model
{
    //
    protected $table='mandira_mentorings';
    protected $connection='mandira';

    // protected $primaryKey = ['id_mentoring'];
    public $timestamps=false;
}
