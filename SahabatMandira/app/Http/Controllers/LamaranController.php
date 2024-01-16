<?php

namespace App\Http\Controllers;

use App\DokumenLamaran;
use App\DokumenLowongan;
use App\PelatihanPeserta;
use App\Lamaran;
use App\Lowongan;
use App\User;
use App\Us;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Log;
use App\Mail\NotifEmail;
use Illuminate\Support\Facades\Mail;

class LamaranController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $lamarans = Lamaran::where('users_email',Auth::user()->email)->orderBy('tanggal_pelamaran', 'DESC')->get();

        return view('lamaran.lamaranku',compact('lamarans'));
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
        $dokumenLowongan = DokumenLowongan::where('lowongans_id', $request->id_lowongan)->get();
        foreach ($dokumenLowongan as $dokumen) {
            $nama = str_replace(' ', '_', $dokumen->nama);
            $validatedData = $request->validate([
                $nama => 'required|mimes:png,jpg,pdf|max:2048',
            ]);

            $validatedData[$nama] = $request->file($nama)->store($nama);
            $dokumenLamaran = new DokumenLamaran;
            $dokumenLamaran->value = $validatedData[$nama];
            $dokumenLamaran->users_email = Auth::user()->email;
            $dokumenLamaran->dokumen_lowongans_id = $dokumen->id;
            $dokumenLamaran->save();
        }

        $lamaran = new Lamaran();
        $lamaran->lowongans_id = $request->id_lowongan;
        $lamaran->users_email = Auth::user()->email;
        $lamaran->tanggal_pelamaran = Carbon::now();
        $lamaran->status = 'Terdaftar';
        if($request->jenisGaji == 'gajiPokok'){
            $lamaran->gaji=$request->gajiPokok;
        }
        else {
            $lamaran->gaji=$request->minimalGaji."-".$request->maksimalGaji;
        }

        $lamaran->save();

        return redirect()->back()->with('success','Lamaran berhasil dikirim!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lamarans = Lamaran::where('lowongans_id', $id)->get();

        $lowongan = Lowongan::find($id);
        $users = [];
        $pelatihans = [];
        foreach ($lamarans as $lamaran ) {
            $email = $lamaran->users_email;
            $user = User::where('email',$email)->first();
            $users[] = $user;

            $data = DB::connection('mandira')
            ->table('pelatihan_pesertas as pp')
            ->where('email_peserta', $email)
            ->first();

            if($data != null){
                $pelatihans[] = $data;
            }
            else{
                $newData =(object) [
                    "sesi_pelatihans_id" => 36,
                    "email_peserta" => $email,
                    "hasil_kompetensi" => null,
                ];
                $pelatihans[] = $newData;
            }
            
        }

        // dd($pelatihans);
        return view('lamaran.showpelamar',compact('lamarans','pelatihans','users','lowongan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $keterangan = $request->keterangan;
        $keteranganVal = '';

        if($keterangan != null){
        for ($i=0; $i < count($keterangan) ; $i++) { 
            if($keteranganVal == ''){
                $keteranganVal =  $keterangan[$i];
            }
            else{
                $keteranganVal =  $keteranganVal.' , '. $keterangan[$i] ;
            }
        }
    }
        //
        $lamaran = Lamaran::where('users_email',$request->users_email)->where('lowongans_id',$id)
        ->update(['status'=> $request->status , 'keterangan'=>$keteranganVal]);

        $getLamaran =  Lamaran::where('users_email',$request->users_email)->where('lowongans_id',$id)->first();

        // dd($getLamaran->lowongan->perusahaan->nama);

     //SendEmail
     $nama = $getLamaran->users_email;
     $data =[];
     if($request->status == 'Diterima'){
        $data = ['namauser' => $nama , 
        'konten' => 'Selamat! Anda diterima untuk bergabung dengan tim kami di '.$getLamaran->lowongan->perusahaan->nama.'. Mohon konfirmasi tanggal mulai kerja Anda dan detail administratif akan segera disampaikan.'];
     }
     elseif($request->status == 'Tahap Seleksi'){
        $data = ['namauser' => $nama , 
        'konten' => 'Selamat! Lamaran anda telah diterima dan pada saat ini sudah memasuki tahap "Seleksi" .'];
     }
     else{
        $data = ['namauser' => $nama , 
        'konten' => 'Terima kasih atas lamaran Anda untuk posisi di '.$getLamaran->lowongan->perusahaan->nama.'. Saat ini, kami telah memilih kandidat lain yang lebih sesuai dengan kebutuhan kami. Kami menghargai waktu dan usaha Anda.

        Kami mengucapkan terima kasih atas minat Anda dan mendoakan kesuksesan dalam pencarian karier Anda ke depan.'];
     }

    Mail::to('s160419157@student.ubaya.ac.id')->send(new NotifEmail($data));

        //ADD DATA ON TABLE LOG
        $addlog = new Log();
        
        $addlog->aksi = "Update status lamaran lowongan:$id";
        $addlog->keterangan = "Update status lamaran ID - $getLamaran->Id , Email user - $getLamaran->users_email status diubah menjadi $request->status";
        $addlog->users_email = Auth::user()->email;
        $addlog->save();

        return redirect()->back()->with('success','Data pelamar berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getEditForm(Request $request)
    {
        $dokumenLowongan = DokumenLowongan::where('lowongans_id',$request->lowongans_id)->get();
        $dokumenLamaran = [];
        foreach ($dokumenLowongan as $dl ) {
            $dokumenLamaran[] = DokumenLamaran::where('users_email',$request->users_email)->where('dokumen_lowongans_id',$dl->id)->first();
        }
        $lamaran = Lamaran::where('users_email',$request->users_email)->where('lowongans_id',$request->lowongans_id)->first();
        $user = User::find($request->users_email);
        return response()->json(array(
            'status'=>'oke',
            'msg'=>view('lamaran.modalpelamar', compact('lamaran','dokumenLamaran' , 'user'))->render() 
        ), 200);
    }

    public function getDetailLamaranCard(Request $request)
    {
        $lamaran = Lamaran::where('lowongans_id',$request->lowongans_id)->where('users_email',Auth::user()->email)->first();
        $dokumenLowongan = DokumenLowongan::where('lowongans_id',$request->lowongans_id)->get();
        $dokumenLamarans = [];
        foreach ($dokumenLowongan as $dl ) {
            $dokumen = DokumenLamaran::where('users_email',Auth::user()->email)->where('dokumen_lowongans_id',$dl->id)->first();
            $dokumenLamarans[] = $dokumen;
        }
        // dd($dokumenLamarans);
        return response()->json(array(
            'status'=>'oke',
            'msg'=>view('lamaran.cardDetailLamaran', compact('lamaran','dokumenLamarans'))->render() 
        ), 200);
    }

    
    public function showRiwayat(Request $request)
    {
        $email = $request->users_email;
        $riwayat = Lamaran::where('users_email' , $request->users_email)->get();

        return response()->json(array(
            'status'=>'oke',
            'msg'=>view('lamaran.riwayatLamaran', compact('riwayat' , 'email'))->render() 
        ), 200);
    }
}