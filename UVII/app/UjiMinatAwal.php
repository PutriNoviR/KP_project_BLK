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

        return $arr_data_akhir;
    }    
}
