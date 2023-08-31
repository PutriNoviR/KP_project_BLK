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
        //untuk autentikasi siapa yang sedang login
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //mengambil semua data pada tabel kejuruan
        $kejuruan = Kejuruan::all();

        //mengambil semua data sub kejuruan berdasarkan kejuruannya exp: kejuruan infomation technology maka sub kejuruannya yang tampil sesuai kejuruannya
        $subKejuruan = Subkejuruan::join('kejuruans as k', 'k.id', '=', 'sub_kejuruans.kejuruans_id')
            ->select('sub_kejuruans.id as id', 'sub_kejuruans.nama as nama')
            ->get();

            //apabila yang login adalah admin blk
        if (auth()->user()->role->nama_role == 'adminblk') {

            //blk id yang digunakan secara otomatis akan sesuuai dengan akun blk yang digunakan.
            //cth. dia login sebagai admin blk surabaya maka id blk yang digunakan berasal dari id blk surabaya
            $blk_id = auth()->user()->blks_id_admin;

            //paket program yang digunakan sesuai id blk
            $paketprograms = PaketProgram::where('blks_id', $blk_id)->get();

            //mengambil data blk sesuai dengan id
            $blk = Blk::where('id', $blk_id)->get();
        } else {

            //mengambil data paket program
            $paketprograms = PaketProgram::all();

            // mengambil data blk
            $blk = Blk::all();
        }

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
        // melakukan penghapusan data paket program
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
        $blkUser = auth()->user()->blks_id_admin; //ambil dia dari blk yang mana
        $paketProgram = PaketProgram::find($request->id);
        if (auth()->user()->role->nama_role == 'adminblk') {
            $blk = Blk::where('id', $blkUser)->get();
        } else {
            $blk = Blk::all();
        }
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
        $subkejuruan = Subkejuruan::where('kejuruans_id', $idkejuruan)->get();
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
