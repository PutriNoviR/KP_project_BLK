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
        $settingDurasi = Setting::where('key', 'durasi')->first()->value;
        $settingSoal = Setting::where('key', 'jmlSoal')->first()->value;
        $settingHalaman = Setting::where('key', 'soal_perHalaman')->first()->value;
        
        $list_klaster = DB::table('klaster_psikometrik')->where('id','!=',0)->get();
        $jml_klaster= DB::table('klaster_psikometrik')->where('id','!=',0)->count();
        $list_pertanyaan = Pertanyaan::all();
        $list_jawaban = Jawaban::all();
        // $jawaban = Jawaban::all();
        // return view('soal.index',['data'=>$list_pertanyaan,'jawaban'=>$jawaban]);
        
        //--menu manajemen--
        $role_user = Auth::user()->roles_id;
        $menu_role = DB::table('menu_manajemens_has_roles as mmhs')
                    ->join('menu_manajemens as mm','mmhs.menu_manajemens_id','=','mm.id')
                    ->select('mm.nama', 'mm.url')
                    ->where('roles_id', $role_user)
                    ->where('mm.status','Aktif')
                    ->get();
        
        return view('soal.index',['data'=>$list_pertanyaan, 'data2'=>$list_jawaban, 'data3'=>$list_klaster, 'data4'=>$jml_klaster, 'durasi'=>$settingDurasi, 'soal'=>$settingSoal, 'halaman'=>$settingHalaman, 'menu_role'=>$menu_role]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $namaKlaster= DB::table('klaster_psikometrik')->where('id','!=',0)->get();
        $jml_klaster= DB::table('klaster_psikometrik')->where('id','!=',0)->count();
       // dd($jml_klaster);
         //--menu manajemen--
         $role_user = Auth::user()->roles_id;
         $menu_role = DB::table('menu_manajemens_has_roles as mmhs')
                     ->join('menu_manajemens as mm','mmhs.menu_manajemens_id','=','mm.id')
                     ->select('mm.nama', 'mm.url')
                     ->where('roles_id', $role_user)
                     ->where('mm.status','Aktif')
                     ->get();
        // $jawaban= Jawaban::all();
        // return view('soal.create',['jawaban'=>$jawaban]);
        return view('soal.create', compact('namaKlaster', 'menu_role','jml_klaster'));
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
            $jml_klaster= DB::table('klaster_psikometrik')->where('id','!=',0)->count();
    
            for($i = 0; $i<$jml_klaster; $i++){
              
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
            return redirect()->back()->with('error','Pertanyaan tidak ditemukan');
            // todo = alert('id yang tidak sesuai')
        }
        $jml_klaster= DB::table('klaster_psikometrik')->where('id','!=',0)->count();

        for($i=0; $i<$jml_klaster; $i++){ 

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
        $namaKlaster= DB::table('klaster_psikometrik')->where('id','!=',0)->get();
        $jml_klaster= DB::table('klaster_psikometrik')->where('id','!=',0)->count();
        $id=$request->get('id');
        $data= Pertanyaan::where('id',$id)->first();
        $jawaban = Jawaban::where('question_id',$id)->get();
      
        return response()->json(array(
            'status'=>'oke',
            // 'msg'=>'success'
            'msg'=>view('soal.edit',compact('namaKlaster','jml_klaster','data','jawaban'))->render()
        ),200);
    }

    public function setting(){
        
        return view('soal.setting');
    }

    public function getSetting(Request $request){
      

        if($request->has('value')){
            for($i=0; $i < 3; $i++){

                $dataSetting = [
                    'key' => $request->key[$i],
                    'value' => $request->value[$i]
                ]; 
        
                Setting::where('key', $request->key[$i])->update($dataSetting);
            }

            return redirect()->back()->with('status', 'data berhasil diubah');
        }
        else{
            return redirect()->back()->with('error', 'data gagal diubah');
        }
    
    }

    public function updateEnable(Request $request){
        
        // $dataEnable=[
        //     'is_enable'=>$request->get('value')
        // ];
        // return $request->value;

        DB::connection('uvii')->table('question_admins')->where('id',$request->id)->update(['is_enable'=>$request->value]);

        // Pertanyaan::find($request->id)->update(['is_enable'=>$request->value]);
        
        return response()->json(array(
            'status'=>'Aktif',
            // 'msg'=>'success'
        ),200);
    }

    
}
