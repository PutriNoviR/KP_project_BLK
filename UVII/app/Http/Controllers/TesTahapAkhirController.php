<?php

namespace App\Http\Controllers;

use App\TesTahapAkhir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class TesTahapAkhirController extends Controller
{
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TesTahapAkhir  $tesTahapAkhir
     * @return \Illuminate\Http\Response
     */
    public function show(TesTahapAkhir $tesTahapAkhir)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TesTahapAkhir  $tesTahapAkhir
     * @return \Illuminate\Http\Response
     */
    public function edit(TesTahapAkhir $tesTahapAkhir)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TesTahapAkhir  $tesTahapAkhir
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TesTahapAkhir $tesTahapAkhir)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TesTahapAkhir  $tesTahapAkhir
     * @return \Illuminate\Http\Response
     */
    public function destroy(TesTahapAkhir $tesTahapAkhir)
    {
        //
    }
    public function hasilTes2(Request $request){
        $role_user = Auth::user()->roles_id;
        $menu_role = DB::table('menu_manajemens_has_roles as mmhs')
                    ->join('menu_manajemens as mm','mmhs.menu_manajemens_id','=','mm.id')
                    ->select('mm.nama', 'mm.url')
                    ->where('roles_id', $role_user)
                    ->where('mm.status','Aktif')
                    ->get();
                    
        $user = Auth::user()->email;
        $hasil_Tes_2 = TesTahapAkhir::getDataJawabanAkhir($user);

        return view('hasilTesTahap2.index',compact('hasil_Tes_2','menu_role'));


    }

}
