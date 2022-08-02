<?php

namespace App\Http\Controllers;

use App\Pertanyaan;
use App\Jawaban;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PertanyaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_pertanyaan = Pertanyaan::all();
        // $jawaban = Jawaban::all();
        // return view('soal.index',['data'=>$list_pertanyaan,'jawaban'=>$jawaban]);
        return view('soal.index',['data'=>$list_pertanyaan]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $jawaban= Jawaban::all();
        // return view('soal.create',['jawaban'=>$jawaban]);
        return view('soal.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user()->email;

        $pertanyaan= new Pertanyaan();
        $pertanyaan->pertanyaan= $request->get('pertanyaan');
        $pertanyaan->created_by = $user;
        $pertanyaan->updated_by = $user;

        $pertanyaan->save();

        for($i = 0; $i<5; $i++){
          
            $jawaban = new Jawaban();
            $jawaban->jawaban = $request->jawaban[$i];
            $jawaban->question_id = $pertanyaan->id;
            $jawaban->kejuruans_id = $request->kejuruan[$i];
              
            $jawaban->save();
        }

        return redirect()->route('soal.index')->with('status','Pertanyaan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pertanyaan  $pertanyaan
     * @return \Illuminate\Http\Response
     */
    public function show(Pertanyaan $pertanyaan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pertanyaan  $pertanyaan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pertanyaan $pertanyaan)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pertanyaan  $pertanyaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pertanyaan $pertanyaan)
    {
        $user = Auth::user()->email;

        $pertanyaan= new Pertanyaan();
        $pertanyaan->pertanyaan= $request->get('pertanyaan');
        $pertanyaan->created_by = $user;
        $pertanyaan->updated_by = $user;

        $pertanyaan->save();

        for($i = 0; $i<5; $i++){
          
            $jawaban = new Jawaban();
            $jawaban->jawaban = $request->jawaban[$i];
            $jawaban->question_id = $pertanyaan->id;
            $jawaban->kejuruans_id = $request->kejuruan[$i];
              
            $jawaban->save();
        }
        return redirect()->route('soal.index')->with('status','Pertanyaan berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pertanyaan  $pertanyaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pertanyaan $pertanyaan)
    {
        $pertanyaan = Pertanyaan::find($pertanyaan);
        try{
            $pertanyaan->delete();
            return redirect()->route('soal.index')->with('status','Pertanyaan berhasil dihapus');
        }catch (\PDOException $e) {
            $msg="Data gagal dihapus. Pastikan data child sudah hilang atau tidak berhubungan";

            return redirect()->route('soal.index')-with('error',$msg);
        }
    }
    public function getEditForm(Request $request){
        $id=$request->get('id');
        $data= Pertanyaan::find($id);
        $jawaban = Jawaban::where('question_id',$id)->first();
        // dd($data);
        return response()->json(array(
            'status'=>'oke',
            'msg'=>view('soal.edit',compact('id','data','jawaban'))->render()
        ),200);
    }
}
