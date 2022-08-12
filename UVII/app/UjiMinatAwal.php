<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UjiMinatAwal extends Model
{
    protected $connection = 'uvii';
   
    protected $table = 'uji_minat_awals';

    protected $fillable = [
        'tanggal_mulai','tanggal_selesai', 'kejuruans_id', 'users_email',
     ];

    public function user(){
        return $this->belongsTo('App\User','users_email');
    }

    public function hasilJawabans(){
        return $this->belongsToMany('App\Pertanyaan','hasil_jawabans', 'uji_minat_awals_id',
        'questions_id')->withPivot('jawaban','urutan');
    }

    
    public $timestamps = false;

    public static function insertPertanyaanPerSesi($idSesi, $listPertanyaan){
        $no = 1;
        foreach($listPertanyaan as $pertanyaan){
           
            DB::connection('uvii')->table('hasil_jawabans')->insert([
                'uji_minat_awals_id' => $idSesi,
                'questions_id' => $pertanyaan->id,
                'jawaban' => 0,
                'urutan' => $no
            ]);

            $no++;
        }

        
    }

   public static function updateJawabanPeserta($idSesi, $idPertanyaan, $jawaban)
   {
            DB::connection('uvii')->table('hasil_jawabans')
            ->where('uji_minat_awals_id', $idSesi)
            ->where('questions_id', $idPertanyaan)
            ->update(
                [
                    'jawaban' => $jawaban
                ]
            );
   }

   public static function HitungScore($idSesi){
        // DB::connection('uvii')->table('hasil_jawabans')
          //   ->join('masterblk_db.kejuruans as k','k.id', '=','a.kejuruans_id')
        // ->where('uji_minat_awals_id', $idSesi)
        // ->where('questions_id', $idPertanyaan)
        // ->get('');
        
        DB::connection('uvii')->table('hasil_jawabans as hj')
                      ->select('a.kejuruans_id as kejuruan', DB::raw('(select count(hj.jawaban) as score)'))
                      ->join('uji_minat_awals as uma','uma.id','=','hj.uji_minat_awals_id')
                      ->join('question_admins as qa', 'qa.id', '=', 'hj.questions_id')
                      ->join('answers as a','a.idanswers','=', 'hj.jawaban')
            
                      ->where('hj.uji_minat_awals_id',$idSesi)
                      ->groupBy('a.kejuruans_id')
                      ->get();
   }

}
