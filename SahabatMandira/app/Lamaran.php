<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lamaran extends Model
{
    //
    public $incrementing = false;
    // public $timestamps = false;
    protected $connection = 'mandira';

    public function lowongan()
    {
        return $this->belongsTo('App\Lowongan', 'lowongans_id');
    }
    public function User()
    {
        return $this->belongsTo('App\User','users_email');
    }
}
