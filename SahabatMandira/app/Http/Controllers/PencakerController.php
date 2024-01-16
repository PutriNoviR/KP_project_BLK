<?php

namespace App\Http\Controllers;

use App\Pencaker;
use App\User;
use Illuminate\Http\Request;
use App\Lowongan;
use App\Lamaran;
use Illuminate\Support\Facades\Auth;
use App\DokumenLowongan;
use App\DokumenLamaran;
use App\Log;
use DB;


class PencakerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $dataFilter = Pencaker::all();
        $pencakers =[];
        $pelatihans = [];

        foreach ($dataFilter as $p) {
            if($p->lowongan->perusahaans_id == Auth::user()->perusahaans_id_admin){
                $pencakers[] = $p;
                $email = $p->users_email;

                $data = DB::connection('mandira')
                ->table('pelatihan_pesertas as pp')
                ->where('email_peserta', $email)
                ->first();
                $pelatihans[] = $data;
            }
            else{

            }
        }

        // dd($pelatihans[0]->hasil_kompetensi  );
        
        return view('pencaker.index', compact('pencakers' ,'pelatihans' ));

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
     * @param  \App\Pencaker  $pencaker
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $pencakers = Pencaker::where('Id', $id)->get();
        // $users = [];
        foreach ($pencakers as $p ) {
            $email = $p->users_email;
            $user = User::where('email',$email)->first();
            // $users[] = $user;
        }
        return view('pencaker.index',compact('pencakers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pencaker  $pencaker
     * @return \Illuminate\Http\Response
     */
    public function edit(Pencaker $pencaker)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pencaker  $pencaker
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dari form blade
        $status= $request->get('status');
        //dari DB
        $pencaker =  Pencaker::where('Id',$id)->update(['status'=> $status, 'keterangan'=>$request->keterangan]);
        $getPencaker = Pencaker::where('Id',$id)->first();

        // dd($getPencaker);

        $addlog = new Log();
        $addlog->aksi = "Update Status";
        $addlog->keterangan = "Update status lamaran ID - $getPencaker->Id , Email user - $getPencaker->users_email Status diubah menjadi $status";
        $addlog->users_email = Auth::user()->email;
        $addlog->save();


        return redirect()->back()->with('success','Data pelamar berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pencaker  $pencaker
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pencaker $pencaker)
    {
        //
    }

    public function getEditForm(Request $request)
    {
        $idPencaker = $request->get('Id');
        $lamaran = Pencaker::where('Id',$idPencaker)->first();

        $dokumenLowongan = DokumenLowongan::where('lowongans_id' , $lamaran->lowongans_id)->get();
        $dokumenLamaran = [];

        foreach($dokumenLowongan as $dl){
            $dokumenLamaran[] = DokumenLamaran::where('dokumen_lowongans_id' , $dl->id)->where('users_email',$lamaran->users_email)->first();
        }

        $user = User::find($lamaran->users_email);
        // dd($dokumenLamaran);

        return response()->json(array(
            'status'=>'oke',
            'msg'=>view('pencaker.modal', compact('lamaran', 'dokumenLamaran' , 'user'))->render() 
        ), 200);
    }
}
