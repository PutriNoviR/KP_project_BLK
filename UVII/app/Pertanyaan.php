<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pertanyaan extends Model
{
    protected $connection ="uvii";
    
    protected $table = 'question_admins';

    public function jawaban(){
        return $this->hasMany('App\Jawaban','question_id', 'idanswers');
    }

    protected $fillable = [
        'pertanyaan','created_by', 'updated_by',
     ];

}
