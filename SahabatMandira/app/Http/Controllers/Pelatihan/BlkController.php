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
        return view('blk.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // return view('blk.create');
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
        return redirect()->back()->with('success', 'Data BLK berhasil ditambahkan!');
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
        return view('blk.detail',compact('blk'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Blk $blk)
    {
        // dd($blk);
        return view('blk.update',compact('blk'));
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
        return redirect()->route('blk.index')->with('success', 'Data BLK berhasil diubah!');
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
        try {
            $blk->delete(); 
            return redirect()->route('blk.index')->with('success','Data BLK berhasil dihapus!');
        } catch (\PDOException $e) {
            $msg="Data gagal dihapus";

            return redirect()->route('blk.index')->with('error',$msg);
        }
    }

    public function detail($id){
        $data = BLK::find($id);
        // dd($data);
        return view('blk.detail',['data'=>$data]);
    }


    public function getEditForm(Request $request)
    {
        $blk = Blk::find($request->id);
        return response()->json(array(
            'status'=>'oke',
            'msg'=>view('blk.modal', compact('blk'))->render() 
        ), 200);
        // return view('blk.update',compact('blk'));
    }

}
