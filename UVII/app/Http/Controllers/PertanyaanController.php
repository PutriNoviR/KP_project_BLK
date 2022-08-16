<?php

namespace App\Http\Controllers;

use App\Pertanyaan;
use Illuminate\Validation\Rule;
use App\Jawaban;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Setting;
use Illuminate\Support\Facades\DB;

class PertanyaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_klaster = DB::table('klaster_psikometrik')->get();
        $list_pertanyaan = Pertanyaan::all();
        $list_jawaban = Jawaban::all();
        // $jawaban = Jawaban::all();
        // return view('soal.index',['data'=>$list_pertanyaan,'jawaban'=>$jawaban]);
        return view('soal.index',['data'=>$list_pertanyaan, 'data2'=>$list_jawaban, 'data3'=>$list_klaster]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $namaKlaster= DB::table('klaster_psikometrik')->get();
        
        // $jawaban= Jawaban::all();
        // return view('soal.create',['jawaban'=>$jawaban]);
        return view('soal.create', compact('namaKlaster'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $user = Auth::user()->email;

            $pertanyaan= new Pertanyaan();
            $pertanyaan->pertanyaan= $request->get('pertanyaan');
            $pertanyaan->created_by = $user;
            $pertanyaan->updated_by = $user;
    
            $pertanyaan->save();
    
            for($i = 0; $i<4; $i++){
              
                $jawaban = new Jawaban();
                $jawaban->jawaban = $request->jawaban[$i];
                $jawaban->question_id = $pertanyaan->id;
                $jawaban->klaster_id = $request->kejuruan[$i];
                  
                $jawaban->save();
            }

            return redirect()->route('soal.index')->with('status','Pertanyaan berhasil ditambahkan');
        }
       catch(Exception $e){
            return redirect()->back()->with('error',"pertanyaan gagal diinput!");
       }

        
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

        for($i=0; $i<4; $i++){ 

            $dataJawaban=[
                'jawaban' => $request->jawaban[$i],
                'klaster_id' => $request->kejuruan[$i],
            ];
        //         // $jawaban->question_id = $pertanyaan->id;
              
            Jawaban::where('question_id', $request->old_id)->where('klaster_id', $request->kejuruan[$i])->update($dataJawaban);   
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

            return redirect()->route('soal.index')->with('error',$msg);
        }
    }
    public function getEditForm(Request $request){
        $namaKlaster= DB::table('klaster_psikometrik')->get();

        $id=$request->get('id');
        $data= Pertanyaan::where('id',$id)->first();
        $jawaban = Jawaban::where('question_id',$id)->get();
      
        return response()->json(array(
            'status'=>'oke',
            // 'msg'=>'success'
            'msg'=>view('soal.edit',compact('namaKlaster','data','jawaban'))->render()
        ),200);
    }

    public function setting(){
        
        return view('soal.setting');
    }

    public function getSetting(Request $request){
      

        if($request->has('value')){
            for($i=0; $i < 3; $i++){
                $dataSetting= new Setting();
                $dataSetting->key = $request->key[$i];
               
                $dataSetting->value =$request->value[$i];
        
                $dataSetting->save();
        
            }

            return redirect()->route('soal.index')->with('status', 'data berhasil ditambah');
        }
        else{
            return redirect()->route('soal.index')->with('status', 'data gagal ditambah');
        }
    
    }

    
}
