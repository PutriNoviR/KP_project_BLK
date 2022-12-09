<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Blk;
use App\Kejuruan;
use App\Subkejuruan;
use App\PaketProgram;
use App\SesiPelatihan;
use Dotenv\Result\Success;
use Illuminate\Support\Arr;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class PaketProgramPelatihanController extends Controller
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
        $kejuruan = Kejuruan::all();
        $subKejuruan = Subkejuruan::join('kejuruans as k', 'k.id', '=', 'sub_kejuruans.kejuruans_id')
            ->select('sub_kejuruans.id as id', 'sub_kejuruans.nama as nama')
            ->get();
        if (auth()->user()->role->nama_role == 'adminblk') {
            $blk_id = auth()->user()->blks_id_admin;
            $paketprograms = PaketProgram::where('blks_id', $blk_id)->get();
            $blk = Blk::where('id', $blk_id)->get();
            // $kejuruan = Kejuruan::join('paket_program as p', 'p.kejuruans_id', '=', 'kejuruans.id')
            //     ->where('blks_id', $blk_id)
            //     ->select('kejuruans.id as id', 'kejuruans.nama as nama')
            //     ->get();
            // $subKejuruan = Subkejuruan::join('kejuruans as k', 'k.id', '=', 'sub_kejuruans.kejuruans_id')
            //     ->join('paket_program as p', 'p.kejuruans_id', '=', 'k.id')
            //     ->where('blks_id', $blk_id)
            //     ->select('sub_kejuruans.id as id', 'sub_kejuruans.nama as nama')
            //     ->get();
        } else {
            $paketprograms = PaketProgram::all();

            $blk = Blk::all();
        }
        // dd($blk);

        return view('paketprogram.index', compact('paketprograms', 'blk', 'kejuruan', 'subKejuruan'));
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
        $paketProgram->blks_id = $request->blks_id;

        $paketProgram->kejuruans_id = $request->kejuruans_id;

        $paketProgram->sub_kejuruans_id = $request->sub_kejuruans_id;

        $paketProgram->save();
        return redirect()->back()->with('success', 'Data paket program berhasil ditambahkan!');

        // $sesi = new SesiPelatihan();
        // $sesi->tanggal_pendaftaran = $request->tanggal_pendaftaran;

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
        return view('paketProgram.update', compact('paketProgram'));
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
        return redirect()->back()->with('Success', 'Data paket program berhasil diubah!');
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
        try {
            $paketProgram->delete();
            return redirect()->route('paketProgram.index')->with('success', 'Data paket program berhasil dihapus!');
        } catch (\PDOException $e) {
            $msg = "Data gagal dihapus";

            return redirect()->route('paketProgram.index')->with('error', $msg);
        }
    }

    public function detail($id)
    {
        $data = PaketProgram::find($id);
        return view('PaketProgram.detail', ['data' => $data]);
    }

    public function getEditForm(Request $request)
    {
        $blkUser = auth()->user()->blks_id_admin;
        $paketProgram = PaketProgram::find($request->id);
        if (auth()->user()->role->nama_role == 'adminblk') {
            $blk = Blk::where('id', $blkUser)->get();
        } else {
            $blk = Blk::all();
        }
        // dd($blk);
        $kejuruan = Kejuruan::all();
        $subKejuruan = SubKejuruan::all();

        return response()->json(array(
            'status' => 'oke',
            'msg' => view('paketprogram.modal', compact('paketProgram', 'blk', 'kejuruan', 'subKejuruan'))->render()
        ), 200);
    }

    public function getSubkejuruan(Request $request)
    {
        $idkejuruan = $request->idkejuruan;
        // $idkejuruan = 1;
        $subkejuruan = Subkejuruan::where('kejuruans_id', $idkejuruan)->get();
        // dd('oi');
        $arr_subkejuruan = [];
        $arr = [];

        foreach ($subkejuruan as $sub) {
            $arr['id'] = $sub->id;
            $arr['nama'] = $sub->nama;
            $arr_subkejuruan[] = $arr;
        }
        // return view('paketprogram.index');
        return response()->json($arr_subkejuruan);
    }
}
