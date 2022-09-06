<?php

namespace App\Http\Controllers;

use App\DokumenLowongan;
use App\Lamaran;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LamaranController extends Controller
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
        $dokumenLowongan = DokumenLowongan::where('lowongans_id', $request->id_lowongan)->get();
        foreach ($dokumenLowongan as $dokumen) {
            $validatedData = $request->validate([
                "$dokumen->nama" => 'required|mimes:png,jpg,pdf|max:2048',
            ]);
        }
        dd($request);
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
        return redirect()->back()->with('success','Data pelamar berhasil dibuah!');
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
        $lamaran = Lamaran::where('users_email',$request->users_email)->where('lowongans_id',$request->lowongans_id)->first();
        return response()->json(array(
            'status'=>'oke',
            'msg'=>view('lamaran.modalpelamar', compact('lamaran'))->render() 
        ), 200);
        // return view('blk.update',compact('blk'));
    }
}
