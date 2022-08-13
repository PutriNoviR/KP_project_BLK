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
        
       $data = DB::table('kejuruans as kk') 
            ->select('kk.id as id', 'kk.nama as kejuruan')
            // sub query
            ->addSelect(DB::raw('IFNULL((select count(hj.jawaban) from masterblk_db.kejuruans k 
                    left join uvii_db.answers as a on k.id = a.kejuruans_id
                    left join uvii_db.hasil_jawabans hj on a.idanswers = hj.jawaban
                    inner join uvii_db.uji_minat_awals as uma on uma.id = hj.uji_minat_awals_id 
                    inner join uvii_db.question_admins as qa on qa.id = hj.questions_id 
                    where hj.uji_minat_awals_id ='.$idSesi.' and k.id = kk.id
                    group by k.nama),0) as score'))
            ->orderBy('score','DESC')
            ->get();

        return $data;        
   }

   public static function updateHasil($idSesi, $data)
   {
        $idKejuruan = 0;
        $score = 0;

        foreach($data as $d){
            $idKejuruan = $d->id;
            $score = $d->score;
        }

        DB::connection('uvii')->table('uji_minat_awals')
            ->where('id', $idSesi)
            ->update(
                [
                    'kejuruans_id' => $idKejuruan,
                    'score' => $score
                ]
            );

    }


   public static function getDataJawaban($idSesi){
       $listJawaban = DB::connection('uvii')->table('hasil_jawabans')
            ->where('uji_minat_awals_id', $idSesi)
            ->get();

        $arr_data = [];

        foreach($listJawaban as $data){
            $arr_data[$data->questions_id] = $data->jawaban;
           
        }

        return $arr_data;
   }

   
}
