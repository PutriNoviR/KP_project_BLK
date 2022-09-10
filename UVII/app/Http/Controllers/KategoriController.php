<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KategoriPsikometrik;
use App\KlasterPsikometrik;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = KategoriPsikometrik::where('id','!=','0')->get();
        $dataKlaster= KlasterPsikometrik::where('id','!=','0')->get();
         // -- menu manajemen --
         $role_user = Auth::user()->roles_id;
         $menu_role = DB::table('menu_manajemens_has_roles as mmhs')
                         ->join('menu_manajemens as mm','mmhs.menu_manajemens_id','=','mm.id')
                         ->select('mm.nama', 'mm.url')
                         ->where('roles_id', $role_user)
                         ->where('mm.status','Aktif')
                         ->get();
        //dd($data);
 
         return view('kategori.index', compact('data','dataKlaster','menu_role'));
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
        $kategori= new KategoriPsikometrik();
        $kategori->nama= $request->get('nama');
        $kategori->kode= $request->get('kode');
        $kategori->kode_poin= $request->get('kode_poin');
        $kategori->klaster_psikometrik_id= $request->get('klaster');
        

        $kategori->save();

        return redirect()->route('kategori.index')->with('status','Kategori berhasil ditambahkan');
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

        $dataKategori=[
            'nama' => $request->get('nama'),
            'kode'=> $request->get('kode'),
            'kode_poin'=> $request->get('kode_poin'),
            'klaster_psikometrik_id'=> $request->get('klaster'),
        ];
        //$dataKategori->save();
        KategoriPsikometrik::where('id',$request->get('id'))->update($dataKategori);
        
        return redirect()->back()->with("success", "Kategori berhasil diubah!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(KategoriPsikometrik $kategori)
    {
        try{
            $kategori->delete();
            return redirect()->back()->with('status','Kategori berhasil dihapus');
        }catch (\PDOException $e) {
            $msg="Data gagal dihapus. Pastikan data child sudah hilang atau tidak berhubungan";

            return redirect()->back()->with('error',$msg);
        }
    }
    public function getEditForm(Request $request){
        $data = KategoriPsikometrik::find($request->id);
        $dataKlaster= KlasterPsikometrik::where('id','!=','0')->get();

        return response()->json(array(
            'status'=>'oke',
            'msg'=>view('kategori.edit', compact('data','dataKlaster'))->render() 
        ), 200);
    }
}
