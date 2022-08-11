<?php

namespace App\Http\Controllers\Pelatihan;

use App\Blk;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Blk::all();
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
        $blk = new Blk();
        $blk->nama = $request->nama;
        $blk->alamat = $request->alamat;
        $blk->website_portfolio = $request->website_portfolio;
        $blk->is_punyasistem = $request->is_punyasistem;
        $blk->link_pendaftaran = $request->link_pendaftaran;
        $blk->save();
        return view();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Blk $blk)
    {
        //
        return view($data = $blk);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Blk $blk)
    {
        //
        return view($data = $blk);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blk $blk)
    {
        //
        $blk->nama = $request->nama;
        $blk->alamat = $request->alamat;
        $blk->website_portfolio = $request->website_portfolio;
        $blk->is_punyasistem = $request->is_punyasistem;
        $blk->link_pendaftaran = $request->link_pendaftaran;
        $blk->save();
        return view();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blk $blk)
    {
        //
        $blk->delete();
        return view();
    }
}
