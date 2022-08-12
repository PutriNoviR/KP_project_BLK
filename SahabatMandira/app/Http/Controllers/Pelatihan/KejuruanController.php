<?php

namespace App\Http\Controllers\Pelatihan;

use App\Http\Controllers\Controller;
use App\Kejuruan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KejuruanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Kejuruan::all();
        // dd($data);
        return view('kejuruan.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('kejuruan.create');
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
        $data = new Kejuruan();
        $data->nama = $request->nama;
        $data->link_kejuruan_tes_2 = $request->link_kejuruan_tes_2;
        // dd($Kejuruan);
        $data->save();
        return view('kejuruan.index', compact('data'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Kejuruan $Kejuruan)
    {
        //
        return view($data = $Kejuruan);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Kejuruan $Kejuruan)
    {
        //
        return view($data = $Kejuruan);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kejuruan $Kejuruan)
    {
        //
        $Kejuruan->nama = $request->nama;
        $Kejuruan->link_kejuruan_test_2 = $request->link_kejuruan_test_2;
        $Kejuruan->save();
        return view();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kejuruan $Kejuruan)
    {
        //
        $Kejuruan->delete();
        return view();
    }

    public function detailAllPelatihan(){
        $data = Kejuruan::join('sub_kejuruans as P', 'kejuruans.id', '=', 'P.kejuruans_id')
        ->join('paket_program AS PP', 'kejuruans.id', '=', 'PP.kejuruans_id')
        ->join('blks AS B', 'B.id', '=', 'PP.blks_id')
        ->join('mandira_db.sesi_pelatihans AS SP', 'SP.paket_program_id', '=', 'PP.id')
        ->select('kejuruans.nama as kejuruan','P.NAMA as program','B.NAMA as blk','B.ALAMAT as alamat', 
                DB::raw('CONCAT(SP.tanggal_pendaftaran, " - ", SP.tanggal_tutup) AS periode'))
        ->groupBy('kejuruans.nama','P.NAMA','B.NAMA','B.ALAMAT','periode')
        ->get();
        return view('report.index', compact('data'));
    }
}
