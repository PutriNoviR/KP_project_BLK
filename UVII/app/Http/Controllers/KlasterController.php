<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KlasterPsikometrik;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class KlasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = KlasterPsikometrik::all();
         // -- menu manajemen --
         $role_user = Auth::user()->roles_id;
         $menu_role = DB::table('menu_manajemens_has_roles as mmhs')
                         ->join('menu_manajemens as mm','mmhs.menu_manajemens_id','=','mm.id')
                         ->select('mm.nama', 'mm.url')
                         ->where('roles_id', $role_user)
                         ->where('mm.status','Aktif')
                         ->get();
 
         return view('klaster.index', compact('data','menu_role'));
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
        
        $klaster= new KlasterPsikometrik();
        $klaster->nama= $request->get('nama');
        $klaster->link_kejuruan_tes_2= $request->get('link_kejuruan_tes_2');
        

        $klaster->save();

        return redirect()->route('klaster.index')->with('status','Klaster berhasil ditambahkan');
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $dataKlaster=[
            'nama' => $request->get('nama'),
            'link_kejuruan_tes_2' => $request->get('link_kejuruan_tes_2'),
        ];
        //$dataKlaster->save();
        KlasterPsikometrik::where('id',$request->get('id'))->update($dataKlaster);
        return redirect()->back()->with("success", "Klaster berhasil diubah!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(KlasterPsikometrik $klaster)
    {
        try{
            $klaster->delete();
            return redirect()->back()->with('status','Kategori berhasil dihapus');
        }catch (\PDOException $e) {
            $msg="Data gagal dihapus. Pastikan data child sudah hilang atau tidak berhubungan";

            return redirect()->back()->with('error',$msg);
        }
    }

    public function getEditForm(Request $request){
        $data = KlasterPsikometrik::find($request->id);

        return response()->json(array(
            'status'=>'oke',
            'msg'=>view('klaster.edit', compact('data'))->render() 
        ), 200);
    }
}
