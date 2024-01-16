<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class BLKInstrukturController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //mengambil data instruktur 
        $instruktur = User::where('roles_id', 4)->get();
        //mengambil data instruktur yang ada di blk tertentu
        $data = User::where('roles_id',4)
                ->where('blks_id_admin',auth()->user()->blks_id_admin)
                ->get();
        // dd($instruktur);
        return view('blk-instruktur.index',compact('instruktur','data'));
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
        //insert data instruktur blk
        $email_inst = $request->email;
        $blk_id = auth()->user()->blks_id_admin;

        $user = User::find($email_inst);
        $user->blks_id_admin = $blk_id;
        $user->save();

        return redirect()->back()->with('success', 'Data Instruktur Berhasil Ditambahkan !');
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Hapus data instruktur blk
        $user=User::find($id);
        $user->blks_id_admin = null;
        $user->save();
        return redirect()->back()->with('success', 'Data Instruktur Berhasil Dihapus !');
    }
}
