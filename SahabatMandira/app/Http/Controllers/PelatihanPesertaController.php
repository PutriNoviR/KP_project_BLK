<?php

namespace App\Http\Controllers;

use App\PelatihanPeserta;
use App\User;
use Auth;
use Illuminate\Http\Request;

class PelatihanPesertaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = PelatihanPeserta::all();

        $peserta = User::join('mandira_db.pelatihan_pesertas as P', 'users.email', '=', 'P.email_peserta')
        ->join('mandira_db.sesi_pelatihans as S', 'P.sesi_pelatihans_id', '=', 'S.id')
        ->get();
        // dd($data);
        return view('pelatihanpeserta.index', compact('data','peserta'));
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
     * @param  \App\PelatihanPeserta  $pelatihanPeserta
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $data = PelatihanPeserta::all();
        // dd($data);
        return view('pelatihanpeserta.index',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PelatihanPeserta  $pelatihanPeserta
     * @return \Illuminate\Http\Response
     */
    public function edit(PelatihanPeserta $pelatihanPeserta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PelatihanPeserta  $pelatihanPeserta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PelatihanPeserta $pelatihanPeserta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PelatihanPeserta  $pelatihanPeserta
     * @return \Illuminate\Http\Response
     */
    public function destroy(PelatihanPeserta $pelatihanPeserta)
    {
        //
    }

    public function lengkapiBerkas()
    {
        $userLogin = auth()->user()->email;
        $data = User::all()->where('email','=',$userLogin);
        // $datas = $data->email;
        // dd($data);
        return view('pelatihanpeserta.kelengkapanDokumen',compact('data'));
    }

    public function pendaftaran()
    {
        return view('pelatihanpeserta.pendaftaranPeserta');
    }
    public function getEditForm(Request $request)
    {
        
        $data = PelatihanPeserta::find($request->sesi_pelatihans_id);
        // dd($data);
        return response()->json(array(
            'status'=>'oke',
            'msg'=>view('pelatihanpeserta.modal', compact('data'))->render() 
        ), 200);
    }
}
