<?php

namespace App\Http\Controllers\Bursa;

use App\Http\Controllers\Controller;
use App\ListKerja;
use Illuminate\Http\Request;
use App\Perusahaan;

class ListKerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // return view ("bursa.listKerja");
        $data=Perusahaan::ListKerja();
        return view('bursa.listKerja', compact('data'));
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
     * @param  \App\ListKerja  $listKerja
     * @return \Illuminate\Http\Response
     */
    public function show(ListKerja $listKerja)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ListKerja  $listKerja
     * @return \Illuminate\Http\Response
     */
    public function edit(ListKerja $listKerja)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ListKerja  $listKerja
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ListKerja $listKerja)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ListKerja  $listKerja
     * @return \Illuminate\Http\Response
     */
    public function destroy(ListKerja $listKerja)
    {
        //
    }

    // public function posting(){
    //     $data=Perusahaan::ListKerja();
    //     return view('bursa.listKerja', compact('data'));
    // }
}
