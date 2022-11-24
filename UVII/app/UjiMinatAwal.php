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

    public function klaster(){
        return $this->belongsTo('App\KlasterPsikometrik','klaster_id','id');
    }

    public function hasilRekomAkhir(){
        return $this->belongsToMany('App\KategoriPsikometrik', 'uvii_db.hasil_rekomendasi_tes_tahap_2','uji_minat_awals_id','kategori_id')
            ->withPivot('peringkat','tanggal_mulai','tanggal_selesai','score');
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

//    public static function HitungScore($idSesi){
       
//     $data = DB::connection('uvii')->table('klaster_psikometrik as kk')
 
//        ->select('kk.id as id', 'kk.nama as klaster','kk.link_kejuruan_tes_2 as link')
//          // sub query
//          ->addSelect(DB::raw('IFNULL((select count(hj.jawaban) from klaster_psikometrik k 
//                 left join uvii_db.answers as a on k.id = a.klaster_id
//                  left join uvii_db.hasil_jawabans hj on a.idanswers = hj.jawaban
//                 inner join uvii_db.uji_minat_awals as uma on uma.id = hj.uji_minat_awals_id 
//                  inner join uvii_db.question_admins as qa on qa.id = hj.questions_id 
//                  where hj.uji_minat_awals_id ='.$idSesi.' and k.id = kk.id
//                  group by k.nama),0) as score'))
//          ->where('kk.id', '!=' ,'0')
//          ->orderBy('score','DESC')
//          ->get();
// //	dd($data);

//      return $data;        
// }
   public static function HitungScoreMultiServer($idSesi){
    $arr_data = [];
    $arr_data_akhir = [];    

    $dataKlaster = DB::connection('mysql')->table('klaster_psikometrik as kk') 
         ->select('kk.id as id', 'kk.nama as klaster','kk.link_kejuruan_tes_2 as link')
         ->where('id', '!=' ,'0')
         ->get();
    
    foreach($dataKlaster as $k){
        $dataScore = DB::connection('uvii')->table('answers as a')
            ->select(DB::raw('count(hj.jawaban) as score'))
            ->leftJoin('hasil_jawabans as hj', 'a.idanswers', '=', 'hj.jawaban')
            ->join('uji_minat_awals as uma', 'uma.id', '=', 'hj.uji_minat_awals_id') 
            ->join('question_admins as qa', 'qa.id', '=', 'hj.questions_id') 
            ->where('hj.uji_minat_awals_id', $idSesi)
            ->where('a.klaster_id', $k->id)
            ->groupBy('a.klaster_id')
            ->orderBy('score','DESC')
            ->first();

        // dd($dataScore->score);

        if($dataScore != null){
            $arr_data = [
                'id'=>$k->id,
                'nama' => $k->klaster,
                'score' => $dataScore->score,
                'link' => $k->link
            ];
        }
        else{
            $arr_data = [
                'id'=>$k->id,
                'nama'=>$k->klaster,
                'score'=>0,
                'link'=>$k->link
            ];
        }

        array_push($arr_data_akhir, $arr_data);
     
    }
    
    return ['hasil'=>collect($arr_data_akhir)->sortByDesc('score')->all(), 'totalScore'=>collect($arr_data_akhir)->sum('score')];        
}

   public static function updateHasil($idSesi, $data)
   {
        $idKlaster = 0;
        $score = 0;

        foreach($data as $d){
            $idKlaster = $d['id'];
            $score = $d['score'];
        }

        DB::connection('uvii')->table('uji_minat_awals')
            ->where('id', $idSesi)
            ->update(
                [
                    'klaster_id' => $idKlaster,
                    'score' => $score
                ]
            );

    }


   public static function getDataJawaban($idSesi){
       $listJawaban = DB::connection('uvii')->table('hasil_jawabans')
            ->where('uji_minat_awals_id', $idSesi)
            ->orderBy('urutan', 'ASC')
            ->get();

        $arr_data = [];

        foreach($listJawaban as $data){
            $arr_data[$data->questions_id] = $data->jawaban;
           
        }

        return $arr_data;
   }

//    public static function riwayatTes($user){
//         $data= DB::connection('uvii')->table('uji_minat_awals as um')
//                 ->select('um.id','um.tanggal_mulai','um.tanggal_selesai','kp.nama as rekomendasi_klaster')
//                 ->join('masterblk_db.klaster_psikometrik as kp','um.klaster_id','=','kp.id')
//                 ->where('um.users_email',$user)
//                 ->orderBy('um.tanggal_selesai','DESC')
//                 ->get();

//         $idSesi = UjiMinatAwal::where('users_email',$user)->get();

//         return $data;
//    }
//    public static function riwayatTesGlobal(){
//     $data= DB::connection('uvii')->table('uji_minat_awals as um')
//        ->select('um.users_email','um.tanggal_mulai','um.tanggal_selesai','kp.nama as rekomendasi_klaster')
//        ->join('masterblk_db.klaster_psikometrik as kp','um.klaster_id','=','kp.id')
//        //->groupBy('um.users_email')
//        ->orderBy('.tanggal_selesai','DESC')
//        ->get();

//        return $data;
//   }

  public static function selisihDurasiPengerjaan($idSesi){
    $data= DB::connection('uvii')->table('uji_minat_awals')
       ->selectRaw('TIMEDIFF(durasi_awal,sisa_durasi) as durasi')
       ->where('id', $idSesi)
       ->first();

       return $data;
  }

  public static function HasilKlasterSama($listPerScore){
    $totalKlaster = 0;
    $arr_klaster = [];

    foreach(array_slice($listPerScore,0,1) as $d){
        $maxScore = $d['score'];
    }

   foreach($listPerScore as $data){
        if($data['score'] == $maxScore){
            $totalKlaster++;
            array_push($arr_klaster, $data['nama']);
        }
        
   }

    return ['jmlKlaster'=>$totalKlaster, 'namaKlaster'=>$arr_klaster];        
 }

public static function updateHasilTesSama($idSesi, $data, $jawaban){
    $idKlaster = 0;
    $score = 0;

    foreach($data as $d){
        if($d['id'] == $jawaban){
            $idKlaster = $d['id'];
            $score = ($d['score'] + 1);
        }
      
    }

    DB::connection('uvii')->table('uji_minat_awals')
        ->where('id', $idSesi)
        ->update(
            [
                'klaster_id' => $idKlaster,
                'score' => $score
            ]
        );
}

    public static function scoreTertinggi($dataHasil, $idSesi){
        $sesi = UjiMinatAwal::where('id', $idSesi)->orderBy('tanggal_selesai', 'DESC')->first();
        $klasterTerbaru = $sesi->klaster_id;

        $arr_data_akhir = [];

        foreach($dataHasil as $data){
            if($data['id'] != $klasterTerbaru){
                $scoreTerbaru = $data['score'];
            }
            else{
                $scoreTerbaru = $sesi->score;
            }

               $arr_data = [
                    "klaster" => $data['nama'],
                    "score" => $scoreTerbaru,
                    "link" => $data['link'],
                ]; 
            

            array_push($arr_data_akhir, $arr_data);
        }

        //return data array yang sudah tersorting berdasarkan scorenya;
        return collect($arr_data_akhir)->sortByDesc('score')->all();
    }

    public static function insertHasilRekomendasi($idSesi){
        DB::connection('uvii')->table('hasil_rekomendasi_tes_tahap_2')
                ->insert([
                    'uji_minat_awals_id' => $idSesi,
                ]);
    }

    public static function getDataKategoriPsikometrik($sesi){
        $kategori = DB::table('kategori_psikometrik')
                    ->select('id','nama')
                    ->where('id','!=','0')
                    ->get();

        

        foreach($sesi as $s){
            $arr_data = [];
            foreach($kategori as $k){

                $hasilTesTahap2 = DB::connection('uvii')->table('hasil_rekomendasi_tes_tahap_2')
                                ->select('kategori_id')
                                ->where('uji_minat_awals_id',$s->id)
                                ->where('kategori_id',$k->id)
                                ->first();

                if($hasilTesTahap2 != null){
                    array_push($arr_data, $k->nama);
                   
                }
             
            }

            $arr_data_akhir[$s->id] = $arr_data;
        } 

        if(empty($arr_data_akhir)){
            return null;
        }

        return $arr_data_akhir;
    } 
    

    public static function getHasilTahap2($idsesi){
        $kategori = DB::table('kategori_psikometrik as kat')
                    ->select('kat.id as id','kat.nama as nama', 'klas.nama as klaster')
                    ->where('kat.id','!=','0')
                    ->join('klaster_psikometrik as klas','klas.id','kat.klaster_psikometrik_id')
                    ->get();

        $arr_data = [];
        $arr_data_akhir = [];
    
        foreach($kategori as $k){

            $hasilTesTahap2 = DB::connection('uvii')->table('hasil_rekomendasi_tes_tahap_2')
                            ->selectRaw('TIMEDIFF(tanggal_selesai,tanggal_mulai) as durasi')
                            ->addSelect('tanggal_mulai', 'score', 'tanggal_selesai')
                            ->where('uji_minat_awals_id',$idsesi)
                            ->where('kategori_id',$k->id)
                            ->first();

            if($hasilTesTahap2 != null){
                $arr_data=[
                    'nama' => $k->nama,
                    'score' => $hasilTesTahap2->score,
                    'tanggal_mulai' => $hasilTesTahap2->tanggal_mulai,
                    'tanggal_selesai' => $hasilTesTahap2->tanggal_selesai,
                    'durasi' => $hasilTesTahap2->durasi,
                    'klaster' => $k->klaster,
                ];

                array_push($arr_data_akhir, $arr_data);
            }
     
        }

        if(empty($arr_data_akhir)){
            return null;
        }

        return collect($arr_data_akhir)->sortByDesc('score')->all();
    } 


    public static function getSoalTahap2($hasil2, $email){
        $arr_data = [];
        $arr_data_akhir = [];

        $iduser = DB::connection('moodle')->table('mdl_user')
                    ->where('email',$email)
                    ->first();

        if($hasil2 != null){
           
            foreach(array_slice($hasil2, 0, 1) as $d){
                $klaster = $d['klaster'];
            }

            $course = KlasterPsikometrik::where('nama', $klaster)->first();
            $idCourse = (int)substr($course->link_kejuruan_tes_2, -2);

            $idQuiz = DB::connection('moodle')->table('mdl_course_modules')
                    ->select('instance')
                    ->where('id',$idCourse)
                    ->first();

            //cari id tes
            $idtes2 = DB::connection('moodle')->table('mdl_quiz_attempts as qz')
                    ->select('qz.uniqueid')
                    ->where('qz.quiz',$idQuiz->instance)
                    ->where('qz.userid',$iduser->id)
                    ->orderBy('qz.attempt','DESC')
                    ->first();
        
            //ambil soal tahap 2
            $soal = DB::connection('moodle')->table('mdl_question_attempts')
                        ->select('questionsummary as soal', 'responsesummary as jawaban', 'questionid')
                        ->where('questionusageid',$idtes2->uniqueid)
                        ->get();

            foreach($soal as $s){
        
                $fract = DB::connection('moodle')->table('mdl_question_answers')
                            ->select('fraction')
                            ->where('answer', $s->jawaban)
                            ->where('question',$s->questionid)
                            ->first();
               
                if($fract != null){
                    $kategori = DB::table('kategori_psikometrik')
                                ->select('id','nama')
                                ->where('kode_poin',$fract->fraction)
                                ->where('klaster_psikometrik_id',$course->id)
                                ->first();

                    if($kategori != null){
                        $pertanyaan = explode(':',$s->soal);

                        $arr_data = [
                            'soal'=>$pertanyaan[0],
                            'jawaban'=>$s->jawaban,
                            'kategori'=>$kategori->nama,
                            'fraction'=>$fract->fraction,
                        ];

                        array_push($arr_data_akhir, $arr_data);
                    }
                }         
               
            }
        }

        if(empty($arr_data_akhir)){
            return null;
        }
        
        return $arr_data_akhir;
    }
}
