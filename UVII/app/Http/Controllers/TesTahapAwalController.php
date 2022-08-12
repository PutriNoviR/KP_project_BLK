<?php

namespace App\Http\Controllers;

use App\UjiMinatAwal;
use App\Pertanyaan;
use App\Jawaban;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TesTahapAwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UjiMinatAwal  $ujiMinatAwal
     * @return \Illuminate\Http\Response
     */
    public function show(UjiMinatAwal $ujiMinatAwal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UjiMinatAwal  $ujiMinatAwal
     * @return \Illuminate\Http\Response
     */
    public function edit(UjiMinatAwal $ujiMinatAwal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UjiMinatAwal  $ujiMinatAwal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UjiMinatAwal $ujiMinatAwal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UjiMinatAwal  $ujiMinatAwal
     * @return \Illuminate\Http\Response
     */
    public function destroy(UjiMinatAwal $ujiMinatAwal)
    {
        //
    }

    public function menuTesHome(){

        return view('ujiTahapAwal.index');
    }

    public function test(){
        
        $dataSoal = Pertanyaan::inRandomOrder()->simplepaginate(3);

        return view('ujiTahapAwal.coba', compact('dataSoal'));
    }

    public function menuTesUjiTahapAwal(Request $request){
          // insert data uji_tahap_awals
          $email = Auth::user()->email;
        $tes = UjiMinatAwal::where('users_email', $email)->where('tanggal_selesai', null)->first();

        if($tes == null){
            // membuat sesi ujian
            $uji_minat = new UjiMinatAwal();
            $uji_minat->tanggal_mulai = Carbon::now()->format('Y-m-d H:i:m');
            $uji_minat->users_email = Auth::user()->email;
            $uji_minat->kejuruans_id = 0;
         
            $uji_minat->save();
            // membuat soal random dan dikunci

            $dataSoal = Pertanyaan::inRandomOrder()->get();
       
            UjiMinatAwal::insertPertanyaanPerSesi($uji_minat->id, $dataSoal);
        }
        else{
            $uji_minat = $tes;
        }


        // Get soals
        // $dataSoal = Pertanyaan::inRandomOrder(); //->paginate(1);
        // random masuk ke tabel


        $dataSoal = ($uji_minat->hasilJawabans()->orderBy('urutan'))->paginate(1);
        
        $totalSoal = count($uji_minat->hasilJawabans);

        return view('ujiTahapAwal.tes', compact('dataSoal', 'totalSoal'));
    }
    
    public function simpanJawaban(Request $request){
        // ambil value input type hidden (FK uji_Minat_awal)
        // FK soal
        // jawaban (PK jawaban)
        $user = Auth::user()->email;
       
        $tes = UjiMinatAwal::where('users_email', $user)->where('tanggal_selesai', null)->orderBy('tanggal_mulai','DESC')->first();
    
        $id_tes = $tes->id;

        UjiMinatAwal::updateJawabanPeserta($id_tes, $request->soal, $request->jawaban);

        // $tes->hasilJawabans()->attach($request->soal, ['jawaban' => $request->jawaban]);
        // $tes->hasilJawabans->update 

        return response()->json(array(
            'msg'=>"Jawaban tersimpan di tes".$id_tes ." dengan ".$request->soal." dan ".$request->jawaban
        ),200);
    }

    public function hasilTes(){
        $user = Auth::user()->email;
        
        $tes = UjiMinatAwal::where('users_email', $user)->where('tanggal_selesai', null)->orderBy('tanggal_mulai','DESC')->first();
    
        $dataHasil = UjiMinatAwal::HitungScore($tes->id);
        
        dd($dataHasil);
        UjiMinatAwal::where('users_email', $user)->where('tanggal_selesai', null)->update(['tanggal_selesai' => Carbon::now()->format('Y-m-d H:i:m')]);
        
        return view('ujiTahapAwal.hasilJawaban', compact('dataHasil'));
    }

    
}
