<?php

namespace App\Http\Controllers;

use App\MataPelajaran;
use App\PelatihanMentor;
use App\PembelajaranPeserta;
use App\TugasPeserta;
use Exception;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;
// use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

class PembelajaranPesertaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $data = PembelajaranPeserta::all();
        //untuk nampung url yang sedang diakses
        $url = parse_url(URL::full());

        //mengambil id dari sesi
        $id_sesi = (str_replace('=', '', $url['query']));

        //mengambil data instruktur
        $instruktur = PelatihanMentor::where('sesi_pelatihans_id', $id_sesi)
            ->join('masterblk_db.users as u', 'u.email', 'pelatihan_mentors.mentors_email')
            ->select('u.nama_depan', 'u.nama_belakang', 'u.email')
            ->get();

        $mataPelajaran = MataPelajaran::all();

        $mataPelajaranPersesi = PembelajaranPeserta::where('pelajaran_mentor_persesi.sesi_pelatihans_id', $id_sesi)
            ->where('pelajaran_mentor_persesi.is_delete', 0)
            ->join('mata_pelajaran as mp', 'mp.id', 'pelajaran_mentor_persesi.mata_pelajaran_id')
            ->join('masterblk_db.users as u', 'u.email', 'pelajaran_mentor_persesi.mentors_email')
            ->select('u.email', 'u.nama_depan', 'u.nama_belakang', 'mp.id', 'mp.nama as mataPelajaran','mp.gambar')
            ->get();
        // dd($mataPelajaranPersesi);
        return view('pembelajaran.index', compact('instruktur', 'mataPelajaran', 'id_sesi', 'mataPelajaranPersesi'));
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
        try {
            $data = PembelajaranPeserta::where('mata_pelajaran_id', $request->nama)
                ->where('sesi_pelatihans_id', $request->sesi)
                ->where('mentors_email', $request->namaInstruktur)
                ->first();
            //untuk melakukan pengecekan ada datanya atau tidak
            if ($data) {
                PembelajaranPeserta::where('mata_pelajaran_id', $request->nama)
                    ->where('sesi_pelatihans_id', $request->sesi)
                    ->where('mentors_email', $request->namaInstruktur)
                    ->update(['is_delete' => 0]);
            } else {
                //jika is delete tidak sama dengan 1 atau datanya blm ada
                $pembelajaran = new PembelajaranPeserta();
                $pembelajaran->mata_pelajaran_id = $request->nama;
                $pembelajaran->sesi_pelatihans_id = $request->sesi;
                $pembelajaran->mentors_email = $request->namaInstruktur;
                $pembelajaran->save();
            }
            return redirect()->back()->with('success', 'Mata pelajaran dan mentor berhasil ditambahkan!');
        } catch (\Exception $e) {
            $msg = "Data gagal ditambah. Pastikan data belum pernah diinputkan sebelumnya";

            return redirect()->back()->with('error', $msg);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PembelajaranPeserta  $pembelajaranPeserta
     * @return \Illuminate\Http\Response
     */
    public function show(PembelajaranPeserta $pembelajaranPeserta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PembelajaranPeserta  $pembelajaranPeserta
     * @return \Illuminate\Http\Response
     */
    public function edit(PembelajaranPeserta $pembelajaranPeserta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PembelajaranPeserta  $pembelajaranPeserta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PembelajaranPeserta $pembelajaranPeserta)
    {
        //
        try {
            $data = [
                'mata_pelajaran_id'=>$request->nama,
                'sesi_pelatihans_id'=>$request->pembelajaran,
                'mentors_email'=>$request->namaInstruktur
            ];
            
            $daftarPembelajaran = PembelajaranPeserta::where('mata_pelajaran_id',$request->nama)
                ->where('sesi_pelatihans_id',$request->pembelajaran)
                ->where('mentors_email',$request->namaInstruktur)
                ->first();
                if($daftarPembelajaran){
                    return redirect()->back()->with('error', 'Data tidak dapat diubah !');
                }
                else{
                    PembelajaranPeserta::where('mata_pelajaran_id',$request->old_mapel)
                ->where('sesi_pelatihans_id',$request->old_sesi)
                ->where('mentors_email',$request->old_mentor)
                ->update($data);
                return redirect()->back()->with('Success', 'Data mata pelajaran dan instruktur berhasil diubah!');
                }
            // $pembelajaranPeserta->mata_pelajaran_id = $request->nama;
            // $pembelajaranPeserta->sesi_pelatihans_id = $request->pembelajaran;
            // $pembelajaranPeserta->mentors_email = $request->namaInstruktur;
            // $pembelajaranPeserta->save();
            
        } catch (\Exception $e) {
            $msg = "Data gagal dihapus. Pastikan data belum pernah diinputkan sebelumnya";

            return redirect()->back()->with('error', $msg);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PembelajaranPeserta  $pembelajaranPeserta
     * @return \Illuminate\Http\Response
     */
    public function destroy(PembelajaranPeserta $pembelajaranPeserta, Request $request)
    {
        //
        try {
            //$delete_peserta = PelatihanPeserta::WHERE('sesi_pelatihans_id', $id_sesi)->delete();
            $data = PembelajaranPeserta::where('sesi_pelatihans_id', $request->pembelajaran)
                ->where('mentors_email', $request->email)
                ->where('mata_pelajaran_id', $request->id)
                ->update(['is_delete' => 1]);
            // $pembelajaranPeserta->is_delete = 1;
            // $pembelajaranPeserta->save();
            return redirect()->back()->with('success', 'Data mata kuliah berhasil dihapus!');
        } catch (\PDOException $e) {
            $msg = "Data gagal dihapus";

            return redirect()->back()->with('error', $msg);
        }
    }

}
