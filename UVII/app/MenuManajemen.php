<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MenuManajemen extends Model
{
    protected $table ="menu_manajemens";
    
    public function tambahMenu(){
        return $this->belongsToMany('App\Role','menu_manajemens_has_roles','menu_manajemens_id', 'roles_id');
    }

    public static function insertMenuRole($idRole, $arr_menu){
           
        DB::table('menu_manajemens_has_roles')
                    ->where('roles_id',$idRole)
                    ->delete();

        foreach($arr_menu as $menu){
            DB::table('menu_manajemens_has_roles')->insert([
                'menu_manajemens_id' => $menu,
                'roles_id' => $idRole,
            ]);
               
        }    
    }

    public static function deleteMenuRole($id){
       DB::table('menu_manajemens_has_roles')
                ->where('menu_manajemens_id', $id)
                ->delete();

        DB::table('menu_manajemens')
            ->where('id', $id)
            ->delete();
    }

   
}
