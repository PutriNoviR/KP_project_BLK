<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = "settings";
    
    protected $connection ="uvii";
    
    public $timestamps = false;

    protected $fillable = [
        'key',
        'value',  
      ];
}
