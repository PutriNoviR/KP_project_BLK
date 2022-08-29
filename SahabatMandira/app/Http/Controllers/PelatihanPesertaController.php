<?php

namespace App\Http\Controllers;

use App\PelatihanPeserta;
use App\SesiPelatihan;
use App\User;
use Auth;
use DB;
use Illuminate\Http\Request;

class PelatihanPesertaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = PelatihanPeserta::all();

        $peserta = User::join('mandira_db.pelatihan_pesertas as P', 'users.email', '=', 'P.email_peserta')
        ->join('mandira_db.sesi_pelatihans as S', 'P.sesi_pelatihans_id', '=', 'S.id')
        ->get();

        // dd($data);
        return view('pelatihanpeserta.index', compact('data','peserta'));
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
    public function store(Request $request, $id)
    {
        //
        $email = auth()->user()->email;
        $insert = array(
            'email' => $email,
            'sesi_pelatihans_id' => $id,
            'status' => $request->get('status'),
            'tanggal_seleksi' => $request->get('tanggal_seleksi'),
        );

        DB::connection('mandira')
            ->table('pelatihan_pesertas')
            ->insert($insert);

            
        //

        $data = DB::connection('mandira')
                ->table('pelatihan_pesertas as pp')
                ->join('masterblk_db.users as u', 'pp.email_peserta', '=', 'u.email')
                ->join('sesi_pelatihans as s', 'pp.sesi_pelatihans_id', '=', 's.id')
                ->where('sesi_pelatihans_id',$id)
                ->get();
        //
        dd($data);
        return redirect()->route('pelatihanpeserta.jadwalSeleksi', compact('data'))->with('success', 'Berhasil Mendaftar');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PelatihanPeserta  $pelatihanPeserta
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // return $id;
        //
        $periode = SesiPelatihan::JOIN('mandira_db.pelatihan_pesertas as P', 'P.sesi_pelatihans_id', '=', 'id')
        ->get();
        // dd($periode);
        $data = DB::connection('mandira')
                ->table('pelatihan_pesertas as pp')
                ->join('masterblk_db.users as u', 'pp.email_peserta', '=', 'u.email')
                ->where('sesi_pelatihans_id',$id)
                ->get();

        // dd($data);
        // $data = PelatihanPeserta::all()->where('sesi_pelatihans_id','=',$id);
        // $data = PelatihanPeserta::find($id);
        // dd($data);
        return view('pelatihanpeserta.index',compact('data','periode'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PelatihanPeserta  $pelatihanPeserta
     * @return \Illuminate\Http\Response
     */
    public function edit(PelatihanPeserta $pelatihanPeserta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PelatihanPeserta  $pelatihanPeserta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $email)
    {
        // return $email;

        //yobong
        $update = array(
            'status' => $request->get('status'),
            'rekom_catatan' => $request->get('rekom_catatan'),
            'rekom_nilai_TPA' => $request->get('rekom_nilai_TPA'),
            'rekom_keputusan' => $request->get('rekom_keputusan'),
            'hasil_kompetensi' => $request->get('hasil_kompetensi'),
            'rekom_is_permanent' => $request->get('rekom_is_permanent'),
        );

        DB::connection('mandira')
            ->table('pelatihan_pesertas')
            ->where('sesi_pelatihans_id', $request->get('sesi_pelatihans_id'))
            ->where('email_peserta', $email)
            ->update($update);

        return redirect()->back()->with('success', 'Berhasil Mendaftar');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PelatihanPeserta  $pelatihanPeserta
     * @return \Illuminate\Http\Response
     */
    public function destroy(PelatihanPeserta $pelatihanPeserta)
    {
        //
    }

    public function lengkapiBerkas()
    {
        $userLogin = auth()->user()->email;
        $data = User::all()->where('email','=',$userLogin);
        // $datas = $data->email;
        // dd($data);
        return view('pelatihanpeserta.kelengkapanDokumen',compact('data'));
    }

    public function pendaftaran()
    {
        return view('pelatihanpeserta.pendaftaranPeserta');
    }
    public function getEditForm(Request $request)
    {
        $email = $request->email_peserta;
        // $data = PelatihanPeserta::all()->WHERE('email_peserta','=', $email);
        $data = DB::connection('mandira')
            ->table('pelatihan_pesertas as pp')
            ->where('email_peserta',$email)
            ->get();
    
        // $data = PelatihanPeserta::find($request->id);
        // dd($email);
        return response()->json(array(
            'status'=>'oke',
            'msg'=>view('pelatihanpeserta.modal', compact('data'))->render() 
        ), 200);
    }

    public function storePendaftar(Request $request, $id)
    {
        //
        // $mentor = S
        
        $email = auth()->user()->email;
        $insert = array(
            'email_peserta' => $email,
            'sesi_pelatihans_id' => $id,
            'status' => $request->get('status'),
            'tanggal_seleksi' => $request->get('tanggal_seleksi'),
        );

        DB::connection('mandira')
            ->table('pelatihan_pesertas')
            ->insert($insert);

        //

        $data = DB::connection('mandira')
                ->table('pelatihan_pesertas as pp')
                ->join('masterblk_db.users as u', 'pp.email_peserta', '=', 'u.email')
                ->join('sesi_pelatihans as s', 'pp.sesi_pelatihans_id', '=', 's.id')
                ->where('sesi_pelatihans_id',$id)
                ->get();
        //
        // dd($data);
        return redirect()->route('pelatihanpeserta.jadwalSeleksi', compact('data'))->with('success', 'Berhasil Mendaftar');
    }

}
