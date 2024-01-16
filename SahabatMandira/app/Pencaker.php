<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pencaker extends Model
{
    //
    protected $table = 'lamarans';
    public $connection = "mandira";
    public $timestamps = false;

    public function User()
    {
        return $this->belongsTo('App\User','users_email');
    }
    public function lowongan()
    {
        return $this->belongsTo('App\Lowongan','lowongans_id');
    }
}