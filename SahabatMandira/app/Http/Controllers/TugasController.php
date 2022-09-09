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
        $id = $request->id;
        $tugas = new Tugas();
        $tugas->email_admin = $request->email_admin;
        $tugas->email_mentor = $request->email_mentor;
        $tugas->keterangan = $request->keterangan;
        $tugas->bukti = $request->bukti;
        $tugas->save();


        $userLogin = auth()->user()->email;
        $periode = SesiPelatihan::find($id);
        // dd($periode);
        $data = DB::connection('mandira')
            ->table('pelatihan_pesertas as pp')
            ->join('masterblk_db.users as u', 'pp.email_peserta', '=', 'u.email')
            ->where('sesi_pelatihans_id', $id)
            ->get();

        return view('pelatihanpeserta.index', compact('data', 'periode'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tugas  $tugas
     * @return \Illuminate\Http\Response
     */
    public function show(Tugas $tugas)
    {
        //
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
}
