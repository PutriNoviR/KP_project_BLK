<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
    protected $table ='answers';
    public function pertanyaan(){
        return $this->belongsTo('App\Pertanyaan','question_id');
    }
}
