<?php

namespace App\Http\Controllers;

use App\MandiraMentoring;
use App\Keahlian;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Validator;

class MandiraMentoringController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $mentoring = MandiraMentoring::where('is_validated', '=', '0')->get();
        return view('mentoring.index', compact('mentoring'));
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
        $userLogin = auth()->user()->email;
        // dd($request->tgl_dibuka);
        // $validator = $request->validate([
        //     'gambar' => ['required','mimes:png,jpg'],
        // ]);

        $program = new MandiraMentoring();
        $program->nama_program = $request->nama_program;
        $program->deskripsi_program = $request->deskripsi_program;
        $program->gambar = $request->file('gambar')->store('mentor/gambar');
        $program->tgl_dibuka = $request->tgl_dibuka;
        $program->tgl_ditutup = $request->tgl_ditutup;
        $program->link_pendaftaran = $request->link_pendaftaran;
        $program->email_mentor = $userLogin;
        $program->keahlians_idkeahlians = $request->keahlians_idkeahlians;
        $program->save();
        return redirect()->back()->with('success', 'Program mentor berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MandiraMentoring  $mandiraMentoring
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $data = MandiraMentoring::where('id_mentoring', '=', $id)
            ->get();
        return view('mandiraMentoring.detailPelatihanMentor', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MandiraMentoring  $mandiraMentoring
     * @return \Illuminate\Http\Response
     */
    public function edit(MandiraMentoring $mandiraMentoring)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MandiraMentoring  $mandiraMentoring
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        // $mandiraMentoring = MandiraMentoring::where('id_mentoring',$id)->first();
        // $mandiraMentoring->nama_program = $request->nama_program;
        // $mandiraMentoring->deskripsi_program = $request->deskripsi_program;
        // $mandiraMentoring->link_pendaftaran = $request->link_pendaftaran;

        $update = array(
            'nama_program' => $request->get('nama_program'),
            'deskripsi_program' => $request->get('deskripsi_program'),
            'link_pendaftaran' => $request->get('link_pendaftaran'),
            'tgl_dibuka' => $request->get('tgl_dibuka'),
            'tgl_ditutup' => $request->get('tgl_ditutup'),
            'keahlians_idkeahlians' => $request->get('keahlians_idkeahlians'),
        );

        if($request->file('gambar') != null)
        {
            $update['gambar'] = $request->file('gambar')->store('mentor/gambar');
        }

        DB::connection('mandira')
            ->table('mandira_mentorings')
            ->where('id_mentoring', $id)
            ->update($update);
        return redirect()->route('dashboard')->with('success', 'Program Mentor berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MandiraMentoring  $mandiraMentoring
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $mandiraMentoring = MandiraMentoring::where('id_mentoring', $id);
        try {
            $mandiraMentoring->delete();
            return redirect()->route('dashboard')->with('success', 'Program Mentor berhasil dihapus!');
        } catch (\PDOException $e) {
            $msg = "Data gagal dihapus";

            return redirect()->route('dashboard')->with('error', $msg);
        }
    }

    public function getEditForm(Request $request)
    {
        $userLogin = auth()->user()->email;
        $mentoring = MandiraMentoring::where('id_mentoring', '=', $request->id_mentoring)->first();
        $daftarKeahlian = Keahlian::JOIN('keahlian_users as k', 'k.keahlians_idkeahlians', '=', 'keahlians.idkeahlians')
            ->where('users_email', '=', $userLogin)->get();
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('mentoring.modal', compact('mentoring', 'daftarKeahlian'))->render()
        ), 200);
    }

    public function validasi($id)
    {
        $userLogin = auth()->user()->email;
        $update = array(
            'is_validated' => 1,
            'validated_by' => $userLogin,
        );

        DB::connection('mandira')
            ->table('mandira_mentorings')
            ->where('id_mentoring', $id)
            ->update($update);

        return redirect()->back()->with('success', 'Program Mentor berhasil divaldasi!');
    }
}
