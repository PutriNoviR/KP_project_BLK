<?php

namespace App\Http\Controllers;

use App\DokumenLamaran;
use App\DokumenLowongan;
use App\Lamaran;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $lamarans = Lamaran::where('users_email',Auth::user()->email)->get();
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
        //
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
        //
        $lamarans = Lamaran::where('lowongans_id', $id)->get();
        $users = [];
        foreach ($lamarans as $lamaran ) {
            $email = $lamaran->users_email;
            $user = User::where('email',$email)->first();
            $users[] = $user;
        }
        return view('lamaran.showpelamar',compact('lamarans','users'));
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
        //
        $lamaran = Lamaran::where('users_email',$request->users_email)->where('lowongans_id',$id)->update(['status'=> $request->status]);
        // dd($lamaran);
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
        return response()->json(array(
            'status'=>'oke',
            'msg'=>view('lamaran.modalpelamar', compact('lamaran','dokumenLamaran'))->render() 
        ), 200);
        // return view('blk.update',compact('blk'));
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
}
