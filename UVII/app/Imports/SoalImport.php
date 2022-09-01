<?php

namespace App\Imports;

use App\Pertanyaan;
use App\Jawaban;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SoalImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // return new Import([
        //     //
        // ]);
        $user = Auth::user()->email;
        $tanggal=Carbon::now()->format('Y-m-d H:i:m');
       
        $data_klaster= DB::table('klaster_psikometrik')
        ->where('nama',$row['klaster'])->first();

        $pertanyaan=[
            'pertanyaan' =>$row['pertanyaan'],
            'created_at'=>$tanggal,
            'updated_at'=>$tanggal,
            'created_by' =>$user, 
            'updated_by'=>$user,
        ];
        // $count_pertanyaan = Pertanyaan::where("pertanyaan",$row['pertanyaan'])->get();
        // // dd($count_pertanyaan);
        // if(count($count_pertanyaan) == 0){
        //     Pertanyaan::insert($pertanyaan);
        // }
        $idSoal = Pertanyaan::orderBy('id','DESC')->first()->id ?? '1';
        $dataSoal = Pertanyaan::where('id', $idSoal)->first();
        //pengecekan 2 jika soal kembar
        if(!$dataSoal || $dataSoal->jawaban->count() == 4){
           
            Pertanyaan::insert($pertanyaan);
        }

       
        // $data_pertanyaan= Pertanyaan::where('pertanyaan',$row['pertanyaan'])->first();
            // dd($data_pertanyaan);
        $jawaban=[
            'jawaban'=> $row['jawaban'],
            'klaster_id'=>$data_klaster->id,
            'question_id'=>Pertanyaan::orderBy('id','DESC')->first()->id,
        ];
        
        Jawaban::insert($jawaban);
    }
}
