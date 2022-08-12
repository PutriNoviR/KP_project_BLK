<?php

namespace App\Http\Controllers\Pelatihan;

use App\Http\Controllers\Controller;
use App\Subkejuruan;
use Illuminate\Http\Request;

class SubkejuruanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Subkejuruan::all();
        return view('subkejuruan.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('subkejuruan.create');
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
        $Subkejuruan = new Subkejuruan();
        $Subkejuruan->nama = $request->nama;
        $Subkejuruan->kejuruans_id = $request->kejuruans_id;
        $Subkejuruan->save();
        return redirect()->back()->with('success', 'Data Subkejuruan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Subkejuruan $Subkejuruan)
    {
        //
        return view('subkejuruan.detail',compact($Subkejuruan));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Subkejuruan $Subkejuruan)
    {
        //
        return view('subkejuruan.edit',compact($Subkejuruan));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subkejuruan $Subkejuruan)
    {
        //
        $Subkejuruan->nama = $request->nama;
        $Subkejuruan->kejuruans_id = $request->kejuruans_id;
        $Subkejuruan->save();
        return redirect()->back()->with('success', 'Data Subkejuruan berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subkejuruan $Subkejuruan)
    {
        //
        $Subkejuruan->delete();
        return redirect()->back()->with('success', 'Data Subkejuruan berhasil dihapus!');
    }

}
