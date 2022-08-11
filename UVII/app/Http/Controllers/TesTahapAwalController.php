<?php

namespace App\Http\Controllers;

use App\UjiMinatAwal;
use App\Pertanyaan;
use App\Jawaban;
use Illuminate\Http\Request;

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
        // insert data uji_tahap_awals
        // get id

        return view('ujiTahapAwal.index');
    }

    public function menuTesUjiTahapAwal(){
        $dataSoal = Pertanyaan::inRandomOrder()->limit(3)->get();

        return view('ujiTahapAwal.tes', compact('dataSoal'));
    }
}
