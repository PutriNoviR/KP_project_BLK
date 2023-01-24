<?php

namespace App\Http\Controllers;

use App\PelatihanMtuPesertas;
use Illuminate\Http\Request;

class PelatihanMtuPesertasController extends Controller
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
     * @param  \App\PelatihanMtuPesertas  $pelatihanMtuPesertas
     * @return \Illuminate\Http\Response
     */
    public function show(PelatihanMtuPesertas $pelatihanMtuPesertas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PelatihanMtuPesertas  $pelatihanMtuPesertas
     * @return \Illuminate\Http\Response
     */
    public function edit(PelatihanMtuPesertas $pelatihanMtuPesertas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PelatihanMtuPesertas  $pelatihanMtuPesertas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PelatihanMtuPesertas $pelatihanMtuPesertas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PelatihanMtuPesertas  $pelatihanMtuPesertas
     * @return \Illuminate\Http\Response
     */
    public function destroy(PelatihanMtuPesertas $pelatihanMtuPesertas)
    {
        //
    }

    
    public function getDetailKtp(Request $request)
    {
        $pelatihanMtuPesertas = PelatihanMtuPesertas::find($request->id);
        // dd($sub);
        $ktp = $pelatihanMtuPesertas->ktp;
        return response()->json(array(
            'status'=>'oke',
            'data'=> $ktp
        ), 200);
    }

    public function getDetailIjazah(Request $request)
    {
        $pelatihanMtuPesertas = PelatihanMtuPesertas::find($request->id);
        // dd($sub);
        $ijazah = $pelatihanMtuPesertas->ijazah;
        return response()->json(array(
            'status'=>'oke',
            'data'=> $ijazah
        ), 200);
    }
}
