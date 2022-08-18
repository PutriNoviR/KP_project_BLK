<?php

namespace App\Http\Controllers\Pelatihan;

use App\Blk;
use App\Http\Controllers\Controller;
use App\Kejuruan;
use App\PaketProgram;
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
        $paket_programs = PaketProgram::all();
        $blks = Blk::all();
        $kejuruans=  Kejuruan::all();
        $subs = Subkejuruan::all();
        return view('subkejuruan.index',compact('subs','kejuruans','blks','paket_programs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $kejuruan = Kejuruan::all();
        return view('subkejuruan.create', compact('kejuruan'));
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
        $Subkejuruan->nama = $request->nama_subkejuruan;
        $Subkejuruan->kejuruans_id = $request->kejuruans_id;
        $Subkejuruan->save();

        $paket_program = PaketProgram::where('blks_id',$request->blks_id)->where('kejuruans_id',$request->kejuruans_id)->whereNull('sub_kejuruans_id')->first();
        if ($paket_program == null) {
            $paket_program = new PaketProgram;
            $paket_program->blks_id = $request->blks_id;
            $paket_program->kejuruans_id = $request->kejuruans_id;
        }
        $paket_program->sub_kejuruans_id = $Subkejuruan->id;
        $paket_program->save();

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
        return view('subkejuruan.detail',compact('Subkejuruan'));
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
        $kejuruan = Kejuruan::all();
        return view('subkejuruan.edit',compact('Subkejuruan','kejuruan'));
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
