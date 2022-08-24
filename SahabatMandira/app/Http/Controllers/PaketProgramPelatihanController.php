<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Blk;
use App\Kejuruan;
use App\SubKejuruan;
use App\PaketProgram;
use Dotenv\Result\Success;
use Illuminate\Support\Arr;

class PaketProgramPelatihanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
        $data = PaketProgram::all();

        $blk = Blk::all();
        $kejuruan = Kejuruan::all();
        $subKejuruan = SubKejuruan::all();
        
        return view('paketprogram.index', compact('data','blk','kejuruan','subKejuruan'));
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
        $paketProgram = new PaketProgram();
        //
        $paketProgram->blks_id = $request->namaBlk;

        $paketProgram->kejuruans_id = $request->kejuruan;

        $paketProgram->sub_kejuruans_id = $request->subKejuruan;

        $paketProgram->save();
        return redirect()->back()->with('success', 'Data paket program berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($paketprogram)
    {
        //
        return view('paketprogram.blade', compact('paketProgram'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($paketProgram)
    {
        //
        return view ('paketProgram.update',compact('paketProgram'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaketProgram $paketProgram)
    {
        
        $paketProgram->blks_id = $request->namaBlk;

        $paketProgram->kejuruans_id = $request->kejuruan;

        $paketProgram->sub_kejuruans_id = $request->subKejuruan;
        $paketProgram->save();
        return redirect()->back()->with('Success','Data paket program berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaketProgram $paketProgram)
    {
        //
        try{
            $paketProgram->delete();
            return redirect()->route('paketProgram.index')->with('success', 'Data paket program berhasil dihapus!');
        } catch (\PDOException $e){
            $msg="Data gagal dihapus";

            return redirect()->route('paketProgram.index')->with('error',$msg);
        }
    }

    public function detail($id){
        $data = PaketProgram::find($id);
        return view('PaketProgram.detail',['data'=>$data]);
    }

    public function getEditForm(Request $request){
        $paketProgram = PaketProgram::find($request->id);
        $blk = Blk::all();
        $kejuruan = Kejuruan::all();
        $subKejuruan = SubKejuruan::all();
        
        return response()->json(Array(
            'status'=>'oke',
            'msg'=>view('paketprogram.modal',compact('paketProgram','blk','kejuruan','subKejuruan'))->render()),200);
    }
}
