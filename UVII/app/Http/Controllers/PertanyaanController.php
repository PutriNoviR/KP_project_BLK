<?php

namespace App\Http\Controllers;

use App\Pertanyaan;
use Illuminate\Validation\Rule;
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
        $list_jawaban = Jawaban::all();
        // $jawaban = Jawaban::all();
        // return view('soal.index',['data'=>$list_pertanyaan,'jawaban'=>$jawaban]);
        return view('soal.index',['data'=>$list_pertanyaan, 'data2'=>$list_jawaban]);
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

        $dataPertanyaan=[
            'pertanyaan' => $request->get('pertanyaan'),
            'created_by' => $request->old_creator,
            'updated_by' => $user,
        ];

        // dd($request->old_id);
        if(Pertanyaan::find($request->old_id) != null){
            Pertanyaan::find($request->old_id)->update($dataPertanyaan);
        }else{
            return;
            // todo = alert('id yang tidak sesuai')
        }
        
      

        for($i=0; $i<5; $i++){ 

            $dataJawaban=[
                'jawaban' => $request->jawaban[$i],
                'kejuruans_id' => $request->kejuruan[$i],
            ];
        //         // $jawaban->question_id = $pertanyaan->id;
              
            Jawaban::where('question_id', $request->old_id)->where('kejuruans_id', $request->kejuruan[$i])->update($dataJawaban);   
        //    }
        }
    
        return redirect()->back()->with('status','Pertanyaan berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pertanyaan  $pertanyaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Pertanyaan $pertanyaan)
    {
        try{
            Jawaban::where('question_id', $request->old_id)->delete();
            Pertanyaan::find($request->old_id)->delete();

            return redirect()->route('soal.index')->with('status','Pertanyaan berhasil dihapus');
        }catch (\PDOException $e) {
            $msg="Data gagal dihapus. Pastikan data child sudah hilang atau tidak berhubungan";

            return redirect()->route('soal.index')-with('error',$msg);
        }
    }
    public function getEditForm(Request $request){
        $id=$request->get('id');
        $data= Pertanyaan::where('id',$id)->first();
        $jawaban = Jawaban::where('question_id',$id)->get();
        // dd($data);
        return response()->json(array(
            'status'=>'oke',
            'msg'=>view('soal.edit',compact('data','jawaban'))->render()
        ),200);
    }

    public function setting(){
        return view('soal.setting');
    }

    public function getSetting(Request $request){
        $dataSetting= new setting;
    
        $dataSetting=[
            [
                'key' => "durasi",
                // menit
                'value' =>$request->menit,
            ],
            [
                'key' => "halaman",
                // menit
                'value' =>$request->perHalaman,
            ]
        ];

        $dataSetting->save();

        return redirect()->back()->with('status', 'data berhasil ditambah');
    }
}
