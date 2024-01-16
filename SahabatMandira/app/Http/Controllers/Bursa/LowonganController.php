<?php

namespace App\Http\Controllers\Bursa;

use App\DokumenLowongan;
use App\Http\Controllers\Controller;
use App\Lamaran;
use App\Log;
use App\Lowongan;
use App\bidang_kerja;
use App\User;
use App\Perusahaan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\PelatihanPeserta;
use GuzzleHttp\Client;

use App\Mail\NotifEmail;
use Illuminate\Support\Facades\Mail;



class LowonganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $idperusahaan = Auth::user()->perusahaans_id_admin;
        $data_lowongan= Lowongan::where('perusahaans_id',$idperusahaan)->get();
        $perusahaan = Perusahaan::find($idperusahaan);
        $bidang_kerja = bidang_kerja::all();


        return view('lowongan.index', compact('data_lowongan','perusahaan' ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $bidang_kerja = bidang_kerja::all();

        $client = new Client();
        $response = $client->get('http://opendata.jatimprov.go.id/api/1389/get');
        $cities = json_decode($response->getBody(), true);
        $kota = $cities['data'];

        // dd($kota);

        return view ("lowongan.create", ['bidang' => $bidang_kerja , 'cities' => $kota] );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        //input tidak bisa dikosongi
        $validatedData = $request->validate([
            'deskripsi_kerja' => 'required',
            'kualifikasi_minimal' => 'required',
            'dokumen' => 'required',
            'nama' => 'required',
            'posisi' => 'required',
            'kota' => 'required',
            'sistem_kerja' => 'required',
            'tanggal_pemasangan'=>'required',
            'tanggal_kadaluarsa'=>'required',
            'tanggal_penetapan'=>'required',
            'pendidikan_terakhir'=>'required',
        ]);
        $lowongan = new Lowongan();
        $lowongan->deskripsi_kerja=$validatedData['deskripsi_kerja'];
        $lowongan->kualifikasi_minimal=$validatedData['kualifikasi_minimal'];
        $lowongan->perusahaans_id = $request->perusahaans_id;
        $lowongan->nama = $validatedData['nama'];
        $lowongan->posisi=$validatedData['posisi'];
        $lowongan->kota=$validatedData['kota'];
        $lowongan->tanggal_pemasangan = $validatedData['tanggal_pemasangan'];
        $lowongan->tanggal_kadaluarsa = $validatedData['tanggal_kadaluarsa'];
        $lowongan->tanggal_penetapan = $validatedData['tanggal_penetapan'];
        $lowongan->sistem_kerja=$request->sistem_kerja;
        $lowongan->bidang_kerja_id = $request->bidang;
        $lowongan->pendidikan_terakhir=$request->pendidikan_terakhir;
        if($request->jenisGaji == 'gajiPokok'){
            $lowongan->gaji=str_replace('.' , '' ,$request->gajiPokok) ;
        }
        else {
            $lowongan->gaji=str_replace('.' , '' ,$request->minimalGaji)."-".str_replace('.' , '' ,$request->maksimalGaji);
        }

        if($request->usiaOption == 'rentangUsia'){
            $lowongan->usia = $request->rentang_minimal.'-'. $request->rentang_maksimal;
        }
        else{
            $lowongan->usia = $request->usia_minimal;
        }
        $lowongan->jenis_kelamin = $request->jenis_kelamin;
        $lowongan->save();
        
        foreach ($validatedData['dokumen'] as $dokumen) {
            $dokumenLowongan = new DokumenLowongan();
            $dokumenLowongan->nama = $dokumen;
            $dokumenLowongan->lowongans_id = $lowongan->id;
            $dokumenLowongan->save();
        }

        $idLowongan = Lowongan::all()->last()->id;

        $addlog = new Log();
        $addlog->aksi = "Tambah Lowongan";
        $addlog->keterangan = "Tambah Lowongan ID - $lowongan->id";
        $addlog->users_email = Auth::user()->email;
        $addlog->save();

        return redirect()->back()->with('success', 'Data lowongan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Lowongan  $lowongan
     * @return \Illuminate\Http\Response
     */
    public function show(Lowongan $lowongan)
    {
        //
        $dokumenLowongan = DokumenLowongan::where('lowongans_id', $lowongan->id)->get();
        $lamaran = Lamaran::where('lowongans_id',$lowongan->id)->where('users_email', Auth::user()->email)->first();
        return view('lowongan.detaillowongan',compact('lowongan','lamaran','dokumenLowongan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Lowongan  $lowongan
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Lowongan  $lowongan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lowongan $lowongan)
    {
          //
        $lowongan->nama = $request->nama;
        $lowongan->posisi=$request->posisi;
        $lowongan->kota=$request->kota;
        // $lowongan->gaji=$request->gaji;
        $lowongan->sistem_kerja=$request->sistem_kerja;
        $lowongan->deskripsi_kerja=$request->deskripsi_kerja;
        $lowongan->kualifikasi_minimal=$request->kualifikasi_minimal;
        $lowongan->tanggal_pemasangan = $request->tanggal_pemasangan;
        $lowongan->tanggal_kadaluarsa = $request->tanggal_kadaluarsa;
        $lowongan->tanggal_penetapan = $request->tanggal_penetapan;
        $lowongan->pendidikan_terakhir=$request->pendidikan_terakhir;
        $lowongan->bidang_kerja_id = $request->bidang;
        
        if($request->jenisGaji == 'gajiPokok'){
            $lowongan->gaji=$request->gajiPokok;
        }
        else {
            $lowongan->gaji=$request->minimalGaji."-".$request->maksimalGaji;
        }
        if($request->usiaOption == 'rentangUsia'){
            $lowongan->usia = $request->rentang_minimal.'-'. $request->rentang_maksimal;
        }
        else{
            $lowongan->usia = $request->usia_minimal;
        }

        $lowongan->save();
        if ($request['dokumen']) {
            foreach ($request['dokumen'] as $dokumen) {
                $dokumenLowongan = new DokumenLowongan();
                $dokumenLowongan->nama = $dokumen;
                $dokumenLowongan->lowongans_id = $lowongan->id;
                $dokumenLowongan->save();
            }
        }

        $addlog = new Log();
        $addlog->aksi = "Update Lowongan";
        $addlog->keterangan = "Update Lowongan ID - $lowongan->id";
        $addlog->users_email = Auth::user()->email;
        $addlog->save();

        // return redirect()->back()->with('success', 'Data lowongan berhasil ditambahkan!');
        return redirect()->route('lowongan.index')->with('success', 'Data Lowongan berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lowongan  $lowongan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lowongan $lowongan)
    {
        //
        try {
            $lowongan->delete(); 

            $addlog = new Log();
            $addlog->aksi = "Delete Lowongan";
            $addlog->keterangan = "Delete Lowongan ID - $lowongan->id";
            $addlog->users_email = Auth::user()->email;
            $addlog->save();

            return redirect()->route('lowongan.index')->with('success','Data Lowongan berhasil dihapus!');
        } catch (\PDOException $e) {
            $msg="Data gagal dihapus";

            return redirect()->route('lowongan.index')->with('error',$msg);
        }

        
    }

    public function getEdit(Request $request)
    {
        $id = $request->get('id');
        $lowongan = Lowongan::find($id);
        $dokumenLowongan = DokumenLowongan::where('lowongans_id', $lowongan->id)->get();

        //KOTA
        $client = new Client();
        $response = $client->get('http://opendata.jatimprov.go.id/api/1389/get');
        $cities = json_decode($response->getBody(), true);
        $kota = $cities['data'];
        $bidang = bidang_kerja::all();

        return response()->json(array(
            'status'=>'oke',
            'msg'=>view('lowongan.modal', compact('lowongan', 'dokumenLowongan' , 'kota' , 'bidang'))->render() 
        ), 200);
    }

    public function semuaLowongan()
    {
        $dateNow = date("Y-m-d H:i:s");
        $lowongans = Lowongan::where('tanggal_pemasangan','<=' , $dateNow)
        //INI ADALAH TANGGAL KADALUARSA
        ->where('tanggal_kadaluarsa','>=', $dateNow)
        ->orderBy('tanggal_pemasangan', 'DESC')->get();

        $bidang = bidang_kerja::all();

        $client = new Client();
        $response = $client->get('http://opendata.jatimprov.go.id/api/1389/get');
        $cities = json_decode($response->getBody(), true);
        $kota = $cities['data'];

        // dd($lowongans);

        return view('lowongan.semualowongan', compact('lowongans' , 'bidang' ,'kota' ));
    }

    public function filter(Request $request){

        $filterBidang = $request->bidang;
        $filterKota = $request->kota;
        $filterGaji = $request->gaji;

        // dd($filterGaji);
        $lowongans = null;
        $dateNow = date("Y-m-d H:i:s");

        if($filterBidang != null && $filterKota != null){
            $lowongans = Lowongan::where('tanggal_pemasangan', '<=', $dateNow)
            ->where('tanggal_kadaluarsa', '>=', $dateNow)
            ->where('bidang_kerja_id', $filterBidang)
            ->where('kota', 'like', '%' . $filterKota . '%')
            ->orderBy('tanggal_pemasangan', 'DESC')
            ->get();
        }
        elseif($filterBidang == null && $filterKota == null){
            $lowongans = Lowongan::where('tanggal_pemasangan','<=' , $dateNow)
            //INI ADALAH TANGGAL KADALUARSA
            ->where('tanggal_kadaluarsa','>=', $dateNow)
            ->orderBy('tanggal_pemasangan', 'DESC')->get();
        }
        elseif($filterBidang == null && $filterKota != null){
            $lowongans = Lowongan::where('tanggal_pemasangan', '<=', $dateNow)
            ->where('tanggal_kadaluarsa', '>=', $dateNow)
            ->where('kota',$filterKota )
            ->orderBy('tanggal_pemasangan', 'DESC')
            ->get();

            // dd($lowongans);
        }
        elseif ($filterKota == null && $filterBidang != null) {

            $lowongans = Lowongan::where('tanggal_pemasangan', '<=', $dateNow)
            ->where('tanggal_kadaluarsa', '>=', $dateNow)
            ->where('bidang_kerja_id', $filterBidang)
            ->orderBy('tanggal_pemasangan', 'DESC')
            ->get();
        }
        //

        if($filterGaji != null){
            $min =0;
            $max =0;
            if($filterGaji == '<4'){
                $min = 0;
                $max = 4000000;
            }
            elseif($filterGaji == '4-8') {
                $min =4000000;
                $max = 8000000;
            }
            elseif($filterGaji == '8-15'){
                $min =8000000;
                $max = 15000000;
            }
            elseif($filterGaji == '15-25'){
                $min =15000000;
                $max = 25000000;
            }
            elseif($filterGaji == '25-40'){
                $min =25000000;
                $max = 40000000;
            }
            elseif($filterGaji == '>40'){
                $min = 40000000;
            }

            foreach ($lowongans as $key => $value) {

                if (strpos($value->gaji, '-') !== false) {
                        $dari = explode('-',$value->gaji)[0];
                        $sampai = explode('-',$value->gaji)[1];

                        if((int)$dari >= $min && (int)$sampai <= $max){  
                        }
                        else{
                            unset($lowongans[$key]);
                        }
                    }
                else{
                        $gaji = $value->gaji;
                        if((int)$gaji >= $min && (int)$gaji <= $max){  
                        }
                        else{
                            unset($lowongans[$key]);
                        }
                    }
            }
        }
        return response()->json(array(
            'status'=>'oke',
            'msg'=>view('lowongan.modal_searchLowongan', compact('lowongans'))->render() 
        ), 200);

    }

    public function showlog($id){
        $lowongan = Lowongan::where('id', $id)->first();

        // dd($lowongan);
        $showLog = Log::where('aksi','Update status lamaran lowongan:'.$id)->get();
        return view('lowongan.log', compact('lowongan', 'showLog'));

    }

    public function view(Request $request)
    {
        $id = $request->get('id');
        $lowongan = Lowongan::find($id);
        $dokumenLowongan = DokumenLowongan::where('lowongans_id', $lowongan->id)->get();
        return response()->json(array(
            'status'=>'oke',
            'msg'=>view('lowongan.view', compact('lowongan', 'dokumenLowongan'))->render() 
        ), 200);
    }
    public function search(Request $request){

        $searchTerm = $request->input('searchTerm');
        $lowongans = Lowongan::where('posisi', 'like', '%' . $searchTerm . '%') ->orderBy('tanggal_pemasangan', 'DESC')->get();


            return response()->json(array(
                'status'=>'oke',
                'msg'=>view('lowongan.modal_searchLowongan', compact('lowongans'))->render() 
            ), 200);

    }
}