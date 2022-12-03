<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MinatUser extends Model
{
    //
    protected $table = 'minat_user';

    protected $primaryKey = 'users_email,kategori_psikometrik_id';
}
