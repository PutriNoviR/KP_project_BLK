<?php

namespace App\Http\Controllers;

use App\MenuManajemen;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MenuManajemenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = Role::all();
        $menu = MenuManajemen::all();
        
        // --menu manajemen--
        $role_user = Auth::user()->roles_id;
        $menu_role = DB::table('menu_manajemens_has_roles as mmhs')
                    ->join('menu_manajemens as mm','mmhs.menu_manajemens_id','=','mm.id')
                    ->select('mm.nama', 'mm.url')
                    ->where('roles_id', $role_user)
                    ->where('mm.status','Aktif')
                    ->get();

        return view('menuManajemen.index',compact('menu', 'role', 'menu_role'));
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

        $menuManajemen= new MenuManajemen();
        $menuManajemen->nama= $request->get('nama');
        $menuManajemen->deskripsi= $request->get('deskripsi');
        $menuManajemen->status= $request->get('status');
        $menuManajemen->url= $request->get('url');
        $menuManajemen->created_at =carbon::now()->format('Y-m-d H:i:m');
        $menuManajemen->updated_at =carbon::now()->format('Y-m-d H:i:m');

        $menuManajemen->save();
        return redirect()->back()->with('status','Menu berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MenuManajemen  $menuManajemen
     * @return \Illuminate\Http\Response
     */
    public function show(MenuManajemen $menuManajemen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MenuManajemen  $menuManajemen
     * @return \Illuminate\Http\Response
     */
    public function edit(MenuManajemen $menuManajemen)
    {
        
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MenuManajemen  $menuManajemen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MenuManajemen $menuManajemen)
    {
        $menuManajemen=[
            'nama'=> $request->get('nama'),
            'deskripsi'=> $request->get('deskripsi'),
            'status'=> $request->get('status'),
            'url'=> $request->get('url'),
            'updated_at' => carbon::now()->format('Y-m-d H:i:m'),
        ];

        MenuManajemen::where('id', $request->id)->update($menuManajemen);

        return redirect()->back()->with('status','Menu berhasil dirubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MenuManajemen  $menuManajemen
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            //dd($);
            //$m->delete()->toSql();
            //dd($m);
            MenuManajemen::deleteMenuRole($id);
            // $menu_manajemen=MenuManajemen::where('id',$id)->first();
            //dd($menu_manajemen);
           // $menu_manajemen->delete();

            return redirect()->back()->with('status','Menu berhasil dihapus');
        }catch (\PDOException $e) {
            $msg="Data gagal dihapus. Pastikan data child sudah hilang atau tidak berhubungan";

            return redirect()->back()->with('error',$msg);
        }

    }
    public function getEditForm(Request $request){
        
        $id=$request->get('id');
        $manajemenEdit = MenuManajemen::where('id',$id)->first();
      
        return response()->json(array(
            'status'=>'oke',
            // 'msg'=>'success'
            'msg'=>view('menuManajemen.edit',compact('manajemenEdit','id'))->render()
        ),200);
    }

    public function menuRole(Request $request){
        try{
          
            MenuManajemen::insertMenuRole($request->role_user, $request->menu);

            return redirect()->back()->with('status','Setting menu berhasil ditambahkan');
        }
       catch(\Exception  $e){
            return redirect()->back()->with('error','Data sudah ada gagal terisi!');
       }
    }

    public function getDataMenu(Request $request){
        $idrole =$request->id;
  
        $menu_role = DB::table('menu_manajemens_has_roles as mmhs')
                    ->join('menu_manajemens as mm','mmhs.menu_manajemens_id','=','mm.id')
                    ->select('mm.id')
                    ->where('mmhs.roles_id',$idrole)
                    ->where('mm.status','Aktif')
                    ->get()->toArray();
        
       $arr_data = [];
        
        foreach($menu_role as $m){
            array_push($arr_data, $m->id);
        }

        return response()->json(array(
            'status'=>'oke',    
            'msg'=>$arr_data
        ),200);
    }
  
}
