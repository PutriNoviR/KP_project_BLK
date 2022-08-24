<?php

namespace App\Http\Controllers;

use App\UjiMinatAwal;
use App\Pertanyaan;
use App\Jawaban;
use App\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $email = Auth::user()->email;
        $tes = UjiMinatAwal::where('users_email', $email)->where('tanggal_selesai', null)->first();

        return view('ujiTahapAwal.index', compact('tes'));
    }

    public function test(){
        
        $dataSoal = Pertanyaan::inRandomOrder()->simplepaginate(3);

        return view('ujiTahapAwal.coba', compact('dataSoal'));
    }

    public function menuTesUjiTahapAwal(Request $request){
          // insert data uji_tahap_awals
          $email = Auth::user()->email;
        $tes = UjiMinatAwal::where('users_email', $email)->where('tanggal_selesai', null)->first();

        //ambil data untuk di setting
       
        $dataSet= Setting::where('key','soal_perHalaman')->first();
        $dataMenit= Setting::where('key','durasi')->first();

        $perPage = $dataSet->value;

        $menit = $dataMenit->value;

        $dataJmlSoal=Setting::where('key','jmlSoal')->first();

        if($tes == null){
            // membuat sesi ujian
            $uji_minat = new UjiMinatAwal();
            $uji_minat->tanggal_mulai = Carbon::now()->format('Y-m-d H:i:m');
            $uji_minat->users_email = Auth::user()->email;
            $uji_minat->klaster_id = 0;
            $uji_minat->sisa_durasi = $menit;
            $uji_minat->durasi_awal = $menit;
            $waktu = explode(':', $uji_minat->sisa_durasi);
           
         
            $uji_minat->save();
            // membuat soal random dan dikunci

            $dataSoal = Pertanyaan::inRandomOrder()->take($dataJmlSoal->value)->get();
       
            UjiMinatAwal::insertPertanyaanPerSesi($uji_minat->id, $dataSoal);
        }
        else{
            $uji_minat = $tes;
           
            $waktu = explode(':',$uji_minat->sisa_durasi);
            
        }
        $waktu1= $waktu[0];
        $waktu2= $waktu[1];

        //ambil hasil jawaban yang tersimpan
        $dataJawaban = UjiMinatAwal::getDataJawaban($uji_minat->id);
        // Get soals
        // $dataSoal = Pertanyaan::inRandomOrder(); //->paginate(1);
        // random masuk ke tabel

        //ambil data jumlah halaman dari setting 
        $dataSoal = ($uji_minat->hasilJawabans()->orderBy('urutan'))->paginate($perPage);
        
        $totalSoal = count($uji_minat->hasilJawabans);
        

        return view('ujiTahapAwal.tes', compact('dataSoal', 'totalSoal','dataJawaban','waktu1', 'waktu2', 'perPage'));
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

    public function hasilTes(Request $request){
        $user = Auth::user()->email;
        
        $tes = UjiMinatAwal::where('users_email', $user)->where('tanggal_selesai', null)->orderBy('tanggal_mulai','DESC')->first() ?? UjiMinatAwal::where('users_email', $user)->orderBy('tanggal_selesai','DESC')->first();

        $dataJawaban = UjiMinatAwal::getDataJawaban($tes->id);
       
        // cek apakah ada soal yang belum terisi dan masih terdapat cukup waktu;
        if(in_array(0, $dataJawaban) && $tes->sisa_durasi != "00:00"){ 
            return redirect()->back()->with('error','Terdapat soal yang belum terjawab. Silahkan gunakan waktu yang tersisa untuk menjawab.');
        }
        else{
            $dataHasil = UjiMinatAwal::HitungScore($tes->id);
            
            $totalScore = $dataHasil->sum('score');

            // dd($totalScore);
            //Mengecek apakah ada hasil score klaster yang sama
            $klaster = UjiMinatAwal::HasilKlasterSama($dataHasil);

            // $data = UjiMinatAwal::where('id', $tes->id)->first();
            $waktu = Setting::where('key', 'durasi')->first();

            $data = UjiMinatAwal::selisihDurasiPengerjaan($tes->id);

            $waktu = explode(':', $data->durasi);
            $waktu1 = $waktu[0];
            $waktu2 = $waktu[1];
           
            // dd($waktu1, $waktu2);
            $klasters = $klaster['jmlKlaster'];
        
            //jika hasil score ada yang sama
            if($klasters > 1){
                //Nama klaster yang sama
                $dataKlaster = DB::table('klaster_psikometrik')->whereIn('nama', $klaster['namaKlaster'])->get();
                

                if($request->jawaban != null){
                    UjiMinatAwal::updateHasilTesSama($tes->id, $dataHasil, $request->jawaban);
                   
                    $klasters = 1;

                    // dd($dataHasil);
                }
            }
            else{
                $dataKlaster = null;
                UjiMinatAwal::updateHasil($tes->id, $dataHasil->take(1));
              
            }
            
            UjiMinatAwal::where('users_email', $user)->where('tanggal_selesai', null)->update(['tanggal_selesai' => Carbon::now()->format('Y-m-d H:i:m')]);
            
            $tesTerbaru = UjiMinatAwal::where('users_email', $user)->orderBy('tanggal_selesai','DESC')->first();

            $dataHasilTerbaru = UjiMinatAwal::scoreTertinggi($dataHasil, $tesTerbaru->id);

            return view('ujiTahapAwal.hasilJawaban', compact('totalScore', 'waktu1','waktu2','klasters', 'dataKlaster', 'tesTerbaru', 'dataHasilTerbaru'));
     
        }
    
    }

    public function updateTimer(Request $request){
        $user = Auth::user()->email;

        $timer = ($request->menit.":".$request->detik);
       
        UjiMinatAwal::where('users_email', $user)->where('tanggal_selesai', null)->update(['sisa_durasi' => $timer]);

        return response()->json(array(
            'msg'=>"Timer updated".$request->jawaban
        ),200);
    }

    public function riwayatTes(){
        $user = Auth::user()->email;
        $riwayat= UjiMinatAwal::riwayatTes($user);

        return view('riwayatUjian.index', compact('riwayat'));

    }
    public function riwayatTesGlobal(){
        
        $riwayat_tes= UjiMinatAwal::riwayatTesGlobal();

        return view('riwayatUjian.riwayatGlobal', compact('riwayat_tes'));

    }
}
