<?php

namespace App\Http\Controllers;

use App\PelatihanMentor;
use Illuminate\Http\Request;

class PelatihanMentorController extends Controller
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
        $pelatihanMentor = new PelatihanMentor();
     
        $pelatihanMentor->sesi_pelatihans_id = $request->sesi_pelatihans_id;
        $pelatihanMentor->mentors_email = $request->mentors_email;
        
        $pelatihanMentor->save();
        
        return redirect()->back()->with("success", "Insturktur berhasil ditambah!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PelatihanMentor  $pelatihanMentor
     * @return \Illuminate\Http\Response
     */
    public function show(PelatihanMentor $pelatihanMentor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PelatihanMentor  $pelatihanMentor
     * @return \Illuminate\Http\Response
     */
    public function edit(PelatihanMentor $pelatihanMentor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PelatihanMentor  $pelatihanMentor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PelatihanMentor $pelatihanMentor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PelatihanMentor  $pelatihanMentor
     * @return \Illuminate\Http\Response
     */
    public function destroy(PelatihanMentor $pelatihanMentor)
    {
        //
    }
}
