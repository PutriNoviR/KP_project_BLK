<?php

namespace App\Http\Controllers;

use App\MataPelajaran;
use App\PaketProgram;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MataPelajaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        //buat lihat siapa yg lagi login
        $idBlk = Auth::user()->blks_id_admin;

        //untuk ambil nama dan id sub kejuruan
        $hasil = PaketProgram::where('blks_id', $idBlk)
            ->join('sub_kejuruans as sk', 'sk.id', '=', 'paket_program.sub_kejuruans_id')
            ->select('sk.id', 'sk.nama')
           
            ->get();


        $mataPelajaran = MataPelajaran::where('is_delete',0)
        ->get();
        return view('matapelajaran.index', compact('hasil', 'mataPelajaran'));
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
        //pengecekan apakah ada yg sama dan perlu diisi
        $this->validate($request, [
            'nama' => ['required', 'string', Rule::unique('mandira.mata_pelajaran', 'nama')->ignore($request->nama, 'nama')]
        ]);

        $mataPelajaran = new MataPelajaran();
        $mataPelajaran->nama = $request->nama;
        $mataPelajaran->gambar = $request->file('fotoMataPelajaran')->store('mataPelajaran');;
        $mataPelajaran->save();
        return redirect()->back()->with('success', 'Mata pelajaran berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MataPelajaran  $mataPelajaran
     * @return \Illuminate\Http\Response
     */
    public function show(MataPelajaran $mataPelajaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MataPelajaran  $mataPelajaran
     * @return \Illuminate\Http\Response
     */
    public function edit(MataPelajaran $mataPelajaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MataPelajaran  $mataPelajaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MataPelajaran $mataPelajaran)
    {
        //
        $mataPelajaran->nama = $request->nama;
        $foto = $request->file('fotoMataPelajaran')->store('mataPelajaran');
        $mataPelajaran->gambar = $foto;
        $mataPelajaran->save();
        return redirect()->back()->with('Success', 'Data mata pelajaran berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MataPelajaran  $mataPelajaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(MataPelajaran $mataPelajaran, Request $request)
    {
        
     

        try {
            //$delete_peserta = PelatihanPeserta::WHERE('sesi_pelatihans_id', $id_sesi)->delete();

            $mataPelajaran->is_delete = 1;
            $mataPelajaran->save();
            return redirect()->back()->with('success', 'Data mata kuliah berhasil dihapus!');
        } catch (\PDOException $e) {
            $msg = "Data gagal dihapus";

            return redirect()->back()->with('error', $msg);
        }
    }
}
