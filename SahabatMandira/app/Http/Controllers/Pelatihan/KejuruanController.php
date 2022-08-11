<?php

namespace App\Http\Controllers\Pelatihan;

use App\Http\Controllers\Controller;
use App\Kejuruan;
use Illuminate\Http\Request;

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
        return view();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view();
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
        $Kejuruan = new Kejuruan();
        $Kejuruan->nama = $request->nama;
        $Kejuruan->link_kejuruan_test_2 = $request->link_kejuruan_test_2;
        $Kejuruan->save();
        return view();
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
}
