<?php

namespace App\Http\Controllers\Bursa;

use App\Perusahaan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PerusahaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Perusahaan::all();
        return view('perusahaan.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view ("perusahaan.create");
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
        dd($request);
        $validatedData = $request->validate([
            'email' => 'required|unique:users|max:255',
            'firstname' => 'required|unique:users|max:255',
            'body' => 'required',
        ]);
        // $perusahaan = new Perusahaan();
        // $perusahaan->nama=$request->nama;
        // $perusahaan->bidang=$request->bidang;
        // $perusahaan->alamat=$request->alamat;
        // $perusahaan->kode_pos=$request->kode_pos;
        // $perusahaan->no_telp=$request->no_telp;
        // $perusahaan->email=$request->email;
        // $perusahaan->logo=$request->logo;
        // $perusahaan->images=$request->foto;
        // $perusahaan->siup=$request->siup;
        // $perusahaan->npwp=$request->npwp;
        // $perusahaan->tentang_perusahaan=$request->tentang_perusahaan;
        // $perusahaan->save();
        return redirect()->back()->with('success', 'Data Perusahaan berhasil ditambahkan!');
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
    public function edit(Perusahaan $perusahaan)
    {
        //
        return view('perusahaan.update',compact('perusahaan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Perusahaan $perusahaan)
    {
        //
        $perusahaan->nama=$request->nama;
        $perusahaan->bidang=$request->bidang;
        $perusahaan->alamat=$request->alamat;
        $perusahaan->kode_pos=$request->kode_pos;
        $perusahaan->no_telp=$request->no_telp;
        $perusahaan->email=$request->email;
        $perusahaan->logo=$request->logo;
        $perusahaan->images=$request->foto;
        $perusahaan->siup=$request->siup;
        $perusahaan->npwp=$request->npwp;
        $perusahaan->tentang_perusahaan=$request->tentang_perusahaan;
        $perusahaan->save();
        return redirect()->route('perusahaan.index')->with('success', 'Data perusahaan berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Perusahaan $perusahaan)
    {
        //
        try {
            $perusahaan->delete(); 
            return redirect()->route('perusahaan.index')->with('success','Data Perusahaan berhasil dihapus!');
        } catch (\PDOException $e) {
            $msg="Data gagal dihapus";

            return redirect()->route('perusahaan.index')->with('error',$msg);
        }
    }

    public function getEdit(Request $request)
    {
        $perusahaan = Perusahaan::find($request->id);
        return response()->json(array(
            'status'=>'oke',
            'msg'=>view('perusahaan.modal', compact('perusahaan'))->render() 
        ), 200);
        // return view('blk.update',compact('blk'));
    }

    // public function posting()
    // {
    //     //compact untuk kirim data
    //     $lowongan = Lowongan::all();
    //     return view("welcome", compact("lowongan"));
    // }
}
