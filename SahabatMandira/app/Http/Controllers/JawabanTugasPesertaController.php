<?php

namespace App\Http\Controllers;

use App\JawabanTugasPeserta;
use App\PelatihanPeserta;
use App\TugasPeserta;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class JawabanTugasPesertaController extends Controller
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
        $jawabanTugasPeserta = new JawabanTugasPeserta();
        $jawabanTugasPeserta->jawaban = $request->jawabanTertulis;
        $jawabanTugasPeserta->jawaban_file = $request->file('fileTugas')->store('jawabanTugasPeserta');
        $jawabanTugasPeserta->users_email = Auth::user()->email;
        $jawabanTugasPeserta->tugas_pesertas_id = $request->id;
        $jawabanTugasPeserta->save();
        return redirect()->back()->with('success', 'Tugas berhasil dikumpulkan!');
    }

    // public function storeNilaiTugas(Request $request)
    // {
    //     $nilaiPeserta = $request->nilai;

    //     $data = ['nilai' => $request->nilai];
    //     JawabanTugasPeserta::where('id', $request->idTugas)
    //         ->update($data);



    //     return redirect()->back()->with('success', 'Nilai Tugas berhasil diinput!');

   
    //     // $file = $request->file('fileTugas')->store('jawabanTugasPeserta');
    //     // $data = ['jawaban' => $request->jawabanTertulis,
    //     // 'jawaban_file' => $file];
    //     // JawabanTugasPeserta::where('id',$request->id)
    //     // ->update($data);

    //     // return redirect()->back()->with('Success', 'Jawaban Tugas berhasil diubah!');

    // }

    public function storeNilaiTugas(Request $request)
    {
        $data = $request->get('nilai');
        
        $arrData = [
            'nilai' => $request->nilai
        ];
        $nilai = DB::table('mandira_db.jawaban_tugas_pesertas')
            ->where('tugas_pesertas_id', $request->get('idTugas'))
            ->where('users_email', $request->get('email_peserta'))->update($arrData);

            PelatihanPeserta::hitungRataRataTugas($request->get('email_peserta'),$request->get('sesi'));

        return redirect()->back()->with('success', 'Input nilai tugas berhasil !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\JawabanTugasPeserta  $jawabanTugasPeserta
     * @return \Illuminate\Http\Response
     */
    public function show(JawabanTugasPeserta $jawabanTugasPeserta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\JawabanTugasPeserta  $jawabanTugasPeserta
     * @return \Illuminate\Http\Response
     */
    public function edit(JawabanTugasPeserta $jawabanTugasPeserta)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\JawabanTugasPeserta  $jawabanTugasPeserta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JawabanTugasPeserta $jawabanTugasPeserta)
    {
        $file = $request->file('fileTugas')->store('jawabanTugasPeserta');
        $data = [
            'jawaban' => $request->jawabanTertulis,
            'jawaban_file' => $file
        ];
        JawabanTugasPeserta::where('id', $request->id)
            ->update($data);

        return redirect()->back()->with('Success', 'Jawaban Tugas berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\JawabanTugasPeserta  $jawabanTugasPeserta
     * @return \Illuminate\Http\Response
     */
    public function destroy(JawabanTugasPeserta $jawabanTugasPeserta, Request $request)
    {
        //
        try {
            JawabanTugasPeserta::WHERE('id', $request->id)->delete();
            return redirect()->back()->with('success', 'Jawaban tugas berhasil dihapus!');
        } catch (\PDOException $e) {
            $msg = "Data gagal dihapus";

            return redirect()->back()->with('error', $msg);
        }
    }

    public function jawabanPeserta(Request $request)
    {

        $semuaJawabanPeserta = TugasPeserta::tugasPesertaBagianAdmin($request->id, '');

        $pesertaTidakMengumpulkan = TugasPeserta::tugasPesertaBagianAdmin($request->id, 'belumMengumpulkan');


        $pesertaSudahMengumpulkan = TugasPeserta::tugasPesertaBagianAdmin($request->id, 'sudahMengumpulkan');

        $pesertaTerlambatMengumpulkan = TugasPeserta::tugasPesertaBagianAdmin($request->id, 'terlambat');

        return view('pembelajaran.lihatTugasPeserta', compact('semuaJawabanPeserta', 'pesertaTidakMengumpulkan', 'pesertaSudahMengumpulkan', 'pesertaTerlambatMengumpulkan'));
    }
}
