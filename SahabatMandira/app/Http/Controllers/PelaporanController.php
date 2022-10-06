<?php

namespace App\Http\Controllers;

use App\Pelaporan;
use Illuminate\Http\Request;

class PelaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('pelaporan.laporan');
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
     * @param  \App\Pelaporan  $pelaporan
     * @return \Illuminate\Http\Response
     */
    public function show(Pelaporan $pelaporan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pelaporan  $pelaporan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pelaporan $pelaporan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pelaporan  $pelaporan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pelaporan $pelaporan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pelaporan  $pelaporan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pelaporan $pelaporan)
    {
        //
    }
}
