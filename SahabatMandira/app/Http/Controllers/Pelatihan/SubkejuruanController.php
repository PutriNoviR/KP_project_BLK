<?php

namespace App\Http\Controllers\Pelatihan;

use App\Blk;
use App\Http\Controllers\Controller;
use App\KategoriPsikometrik;
use App\Kejuruan;
use App\KlasterPsikometrik;
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
        //AMBIL SEMUA DATA DARI TABEL
        $subs = Subkejuruan::all();
        $kejuruans=  Kejuruan::all();
        $kategoris = KategoriPsikometrik::all();
        $klasters = KlasterPsikometrik::all();
        return view('subkejuruan.index',compact('subs','kejuruans','kategoris','klasters'));
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
        // dd($request);
        //insert data ke tabel sub kejuruan
        $Subkejuruan = new Subkejuruan();
        $Subkejuruan->nama = $request->nama_subkejuruan;
        $Subkejuruan->aktivitas = $request->aktivitas;
        $Subkejuruan->kode_kategori = $request->kode_kategori;
        $Subkejuruan->kode_klaster = $request->kode_klaster;
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
        //ubah data yang ada pada tabel sub kejuruan
        $Subkejuruan->nama = $request->nama_subkejuruan;
        $Subkejuruan->aktivitas = $request->aktivitas;
        $Subkejuruan->kode_kategori = $request->kode_kategori;
        $Subkejuruan->kode_klaster = $request->kode_klaster;
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
        //hapus data yang ada pada tabel sub kejuruan
        $Subkejuruan->delete();
        return redirect()->back()->with('success', 'Data Subkejuruan berhasil dihapus!');
    }
    public function getEditForm(Request $request)
    {
        $sub = Subkejuruan::find($request->id);
        $kejuruans=  Kejuruan::all();
        $kategoris = KategoriPsikometrik::all();
        $klasters = KlasterPsikometrik::all();
        return response()->json(array(
            'status'=>'oke',
            'msg'=>view('subkejuruan.modal', compact('sub','kategoris','klasters','kejuruans'))->render() 
        ), 200);
    }

    public function getDetail(Request $request)
    {
        $sub = Subkejuruan::find($request->id);
        // dd($sub);
        $aktivitas = $sub->aktivitas;
        return response()->json(array(
            'status'=>'oke',
            'data'=> $aktivitas
        ), 200);
    }
}
