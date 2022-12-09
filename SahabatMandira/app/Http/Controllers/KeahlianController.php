<?php

namespace App\Http\Controllers;

use App\Keahlian;
use App\KeahlianUser;
use App\User;
use DB;
use Illuminate\Http\Request;

class KeahlianController extends Controller
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
        $keahlian = Keahlian::all();
        // dd($keahlian);
        return view('keahlian.index',compact('keahlian'));
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
        $keahlian = new Keahlian();
        $keahlian->nama = $request->nama;
        $keahlian->save();
        return redirect()->back()->with('success', 'Data Keahlian berhasil ditambahkan!');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Keahlian  $keahlian
     * @return \Illuminate\Http\Response
     */
    public function show(Keahlian $keahlian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Keahlian  $keahlian
     * @return \Illuminate\Http\Response
     */
    public function edit(Keahlian $keahlian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Keahlian  $keahlian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $update = array(
            'nama' => $request->get('nama'),
        );

        DB::table('keahlians')
            ->where('idkeahlians', $id)
            ->update($update);
        return redirect()->back()->with('success', 'Program Keahlian berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Keahlian  $keahlian
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $keahlian = Keahlian::where('idkeahlians', $id);
        try {
            $keahlian->delete();
            return redirect()->back()->with('success', 'Keahlian berhasil dihapus!');
        } catch (\PDOException $e) {
            $msg = "Data gagal dihapus";

            return redirect()->back()->with('error', $msg);
        }
    }

    public function getEditForm(Request $request)
    {
        $keahlian = Keahlian::where('idkeahlians',$request->id)->first();
        // dd($request->id);
        return response()->json(array(
            'status'=>'oke',
            'msg'=>view('keahlian.modal', compact('keahlian'))->render() 
        ), 200);
    }
}
