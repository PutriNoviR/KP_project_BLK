<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UjiMinatAwal extends Model
{
    protected $connection = 'uvii';
   
    protected $table = 'uji_minat_awals';

    protected $fillable = [
        'tanggal_mulai','tanggal_selesai', 'klaster_id', 'users_email',
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

        
       $data = DB::table('klaster_psikometrik as kk') 
            ->select('kk.id as id', 'kk.nama as klaster','kk.link_kejuruan_tes_2 as link')
            // sub query
            ->addSelect(DB::raw('IFNULL((select count(hj.jawaban) from masterblk_db.klaster_psikometrik k 
                    left join uvii_db.answers as a on k.id = a.klaster_id
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
                    'klaster_id' => $idKejuruan,
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

   public static function riwayatTes($user){
     $data= DB::connection('uvii')->table('uji_minat_awals as um')
        ->select('um.tanggal_mulai','um.tanggal_selesai','kp.nama as rekomendasi_klaster')
        ->join('masterblk_db.klaster_psikometrik as kp','um.klaster_id','=','kp.id')
        ->where('um.users_email',$user)
        ->orderBy('um.tanggal_selesai','DESC')
        ->get();

        return $data;
   }
   public static function riwayatTesGlobal(){
    $data= DB::connection('uvii')->table('uji_minat_awals as um')
       ->select('um.users_email','um.tanggal_mulai','um.tanggal_selesai','kp.nama as rekomendasi_klaster')
       ->join('masterblk_db.klaster_psikometrik as kp','um.klaster_id','=','kp.id')
       //->groupBy('um.users_email')
       ->orderBy('um.tanggal_selesai','DESC')
       ->get();

       return $data;
  }

  public static function selisihDurasiPengerjaan($idSesi){
    $data= DB::connection('uvii')->table('uji_minat_awals')
       ->selectRaw('TIMEDIFF(durasi_awal,sisa_durasi) as durasi')
       ->where('id', $idSesi)
       ->first();

       return $data;
  }
}
