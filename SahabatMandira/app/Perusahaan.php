<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Perusahaan extends Model
{
    //
    public $connection = "mandira";
    // public function User()
    // {
    //     return $this->hasMany('App\User','verified_by','id');
    // }

    public function Lowongan()
    {
        return $this->hasMany('App\Lowongan','perusahaans_id');
    }

    public static function ListKerja()
    {
        $data = DB::connection('mandira')->table('perusahaans as p') 
            ->join('lowongans as l', 'p.id','=','l.perusahaans_id')
            ->select('p.logo', 'l.posisi','p.nama','l.tanggal_pemasangan')
            ->orderBy('p.id')
            ->get();

        return $data;
    }
}
