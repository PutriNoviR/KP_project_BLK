<?php

namespace App\Http\Controllers;
use App\Exports\RiwayatExport;
use App\Exports\ListPesertaExport;
use App\TesTahapAkhir;
use App\UjiMinatAwal;
use App\KategoriPsikometrik;
use App\KlasterPsikometrik;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;




use Illuminate\Http\Request;

class ExportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = DB::table('users')->all();
        $riwayat_tes= UjiMinatAwal::all();
        $dataKlaster = KlasterPsikometrik::all();
        $dataKategori = UjiMinatAwal::getDataKategoriPsikometrik($riwayat_tes);
        
        return view('export.index',compact('riwayat_tes','dataKlaster','dataKategori','user'));
        
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
        //
    }
    public function exportExcel(){

        //$nama_file = 'riwayatTesPeserta_'.date('Y-m-d_H-i-s').'.xlsx';
        return Excel::download(new RiwayatExport, 'RiwayatTesPeserta.xlsx');

    }
    public function exportListPeserta(){
        return Excel::download(new ListPesertaExport, 'DaftarPeserta.xlsx');

    }
}
