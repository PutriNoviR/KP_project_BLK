<?php

namespace App\Http\Controllers;

use App\Blk;
use App\PaketProgram;
use App\PelatihanMTU;
use App\PelatihanMtuPesertas;
use App\PesertaMTU;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\ElseIf_;

class MTUController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //
        $role = auth()->user()->role->nama_role;

        $blk = Blk::all();

        if($role == 'peserta')
        {
            $mtu = PelatihanMTU::JOIN('masterblk_db.blks as b','pelatihan_mtus.blk_dituju','b.id')
                ->JOIN('masterblk_db.paket_program as p','pelatihan_mtus.paket_program_id','p.id')
                ->JOIN('masterblk_db.sub_kejuruans as s','p.sub_kejuruans_id','s.id')
                ->WHERE('email_pic', auth()->user()->email)
                ->select('pelatihan_mtus.*','b.nama as blk','s.nama as program')
                ->get();
        }
        elseif($role == 'adminblk' || $role == 'verifikator')
        {
            $mtu = PelatihanMTU::JOIN('masterblk_db.blks as b','pelatihan_mtus.blk_dituju','b.id')
            ->JOIN('masterblk_db.paket_program as p','pelatihan_mtus.paket_program_id','p.id')
            ->JOIN('masterblk_db.sub_kejuruans as s','p.sub_kejuruans_id','s.id')
            ->WHERE('blk_dituju', auth()->user()->blks_id_admin)
            ->select('pelatihan_mtus.*','b.nama as blk','s.nama as program')
            ->get();
        }

        return view('mtu.index',compact('blk','mtu'));
    }

    public function get_program(Request $req)
    {
        $pkt_prog = PaketProgram::JOIN('sub_kejuruans as s', 'paket_program.sub_kejuruans_id', 's.id')
                    ->WHERE('paket_program.blks_id',$req->id)
                    ->select('paket_program.id','s.nama')
                    ->get();
        return response()->json($pkt_prog);
    }

    public function persetujuan(Request $r)
    {
        $id_mtu = $r->id_mtu;
        $persetujuan = $r->persetujuan;

        $mtu = PelatihanMTU::find($id_mtu);
        $mtu->is_accepted = $persetujuan;
       
        if($persetujuan == 1)
        {
          $mtu->harga = $r->harga;
          $pesan = 'Pengajuan MTU Berhasil Disetujui !';
        }
        else
        {
            $mtu->alasan_ditolak = $r->keterangan;
            $pesan = 'Pengajuan MTU Berhasil Ditolak !';
        }
        $mtu->update();
        return redirect()->back()->with('success', $pesan);
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
        $checkKuota = count($request->name);

        if ($checkKuota <= 16) {
            $mtu = new PelatihanMTU();
            $mtu->email_pic = auth()->user()->email;
            $mtu->waktu_mulai = $request->tanggal_mulai_pelatihan;
            $mtu->waktu_selesai = $request->tanggal_selesai_pelatihan;
            $mtu->deskripsi_tempat = $request->lokasi;
            $mtu->blk_dituju = $request->blk;
            $mtu->paket_program_id = $request->program;
            $mtu->keterangan = $request->deskripsi;
            $mtu->proposal = $request->file('proposal')->store('mtu/proposal');
            if(!empty($request->file('surat_pengantar'))){
                $mtu->surat_pengantar = $request->file('surat_pengantar')->store('mtu/surat_pengantar');
            }
            
            $mtu->save();

            for ($i = 0; $i < $checkKuota; $i++) {
                # code...
                $peserta = new PesertaMTU();
                $peserta->ktp = $request->file('ktp')[$i]->store('mtu/ktp');
                $peserta->nama = $request->name[$i];
                $peserta->no_hp = $request->no_telp[$i];
                $peserta->ijazah = $request->file('ijazah')[$i]->store('mtu/ijazah');
                $peserta->pelatihan_mtus_idpelatihan_mtus = $mtu->idpelatihan_mtus;
                $peserta->pendidikan_terakhir = $request->pendidikan_terakhir[$i];
                $peserta->save();
            }

            return redirect()->back()->with('success', "Pengajuan MTU Berhasil !");
        }
        else{
            return redirect()->back()->with('error', "Pengajuan MTU gagal, jumlah peserta melebihi 16 orang !");
        }
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

        $dataPeserta = [];
        $data = PelatihanMTU::join('pelatihan_mtu_pesertas as P', 'pelatihan_mtus.idpelatihan_mtus', '=', 'P.pelatihan_mtus_idpelatihan_mtus')
        ->select('pelatihan_mtus.*','P.*')
        ->where('pelatihan_mtus.idpelatihan_mtus',$id)
        ->get();

        foreach ($data as $d){

            if($d->is_accepted == null){
                PelatihanMtuPesertas::where('pelatihan_mtus_idpelatihan_mtus',$id)->update(['status'=>'MENUNGGU VERIFIKASI PROPOSAL']);
            }
            elseif($d->is_accepted == 1 && Carbon::now()->format('Y-m-d') <= $d->waktu_selesai){
                PelatihanMtuPesertas::where('pelatihan_mtus_idpelatihan_mtus',$id)->update(['status'=>'SEDANG PELATIHAN']);
            }
            elseif($d->is_accepted == 1 && Carbon::now()->format('Y-m-d') >= $d->waktu_selesai){
                PelatihanMtuPesertas::where('pelatihan_mtus_idpelatihan_mtus',$id)->update(['status'=>'SUDAH MENGIKUTI PELATIHAN']);
            }
            else{
                PelatihanMtuPesertas::where('pelatihan_mtus_idpelatihan_mtus',$id)->update(['status'=>'TIDAK DITERIMA']);
            }

        $status = PelatihanMtuPesertas::where('pelatihan_mtus_idpelatihan_mtus',$id)->first();
        $status = $status->status;

            $peserta = [
                'nama' => $d->nama,
                'alamat' => $d->alamat,
                'no_hp' => $d->no_hp,
                'ktp' => $d->ktp,
                'ijazah' => $d->ijazah,
                'id' => $d->id,
                'status' => $d->status
            ];
            
        array_push($dataPeserta, $peserta);
        }

        return view('mtu.detailpeserta', compact('dataPeserta'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
