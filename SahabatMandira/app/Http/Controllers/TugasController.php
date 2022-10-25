<?php

namespace App\Http\Controllers;

use App\Tugas;
use App\SesiPelatihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TugasController extends Controller
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
        $sesiPelatihan_id = $request->id;
        $tugas = new Tugas();
        $tugas->email_admin = $request->email_admin;
        $tugas->email_mentor = $request->email_mentor;
        $tugas->sesi_pelatihans_id = $sesiPelatihan_id;
        $tugas->keterangan = $request->keterangan;
        $tugas->bukti = $request->file('bukti')->store('tugas/bukti');
        
        $tugas->save();

        
        $userLogin = auth()->user()->email;
        $periode = SesiPelatihan::find($sesiPelatihan_id);
        $data = DB::connection('mandira')
            ->table('pelatihan_pesertas as pp')
            ->join('masterblk_db.users as u', 'pp.email_peserta', '=', 'u.email')
            ->where('sesi_pelatihans_id', $sesiPelatihan_id)
            ->get();

        return view('pelatihanpeserta.index', compact('data', 'periode'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tugas  $tugas
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $data = Tugas::all()->where('sesi_pelatihans_id','=',$id);
        // dd($data);
        return view('sesipelatihan.assignTugasVerifikator', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tugas  $tugas
     * @return \Illuminate\Http\Response
     */
    public function edit(Tugas $tugas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tugas  $tugas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tugas $tugas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tugas  $tugas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tugas $tugas)
    {
        //
    }

    public function getDetail(Request $request)
    {
        $tugas = Tugas::find($request->id);
        // dd($sub);
        $bukti = $tugas->bukti;
        return response()->json(array(
            'status'=>'oke',
            'data'=> $bukti
        ), 200);
    }
}
