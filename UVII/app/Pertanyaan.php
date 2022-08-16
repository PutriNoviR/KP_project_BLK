<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pertanyaan extends Model
{
    protected $connection ="uvii";
    
    protected $table = 'question_admins';

    public function jawaban(){
        return $this->hasMany('App\Jawaban','question_id', 'id');
    }

    public function hasilJawabans(){
        return $this->belongsToMany('App\UjiMinatAwals','hasil_jawabans','questions_id',
        'uji_minat_awals_id') -> withPivot('jawaban', 'urutan');
    }

    protected $fillable = [
        'pertanyaan','created_by', 'updated_by',
     ];

    //  public function getNamaKlaster(){
    //     $getNama= DB::table('klaster_psikometrik')->
    //  }

     

}
