<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    

    public function users(){
        return $this->hasMany('App\User','roles_id','id');
    }  
    public function menuManajemens(){
        return $this->belongsToMany('App\MenuManajemen','menu_manajemens_has_roles','menu_manajemens_id','roles_id');
    }  
}
