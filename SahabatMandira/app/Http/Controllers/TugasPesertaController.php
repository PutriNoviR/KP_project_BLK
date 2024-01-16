<?php

namespace App\Http\Controllers;

use App\JawabanTugasPeserta;
use App\MataPelajaran;
use App\PelatihanMentor;
use App\PembelajaranPeserta;
use App\TugasPeserta;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class TugasPesertaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        // $url = parse_url(URL::full());
        //mengambil id dari sesi
        $id_sesi = ($request->sesi);

        //mengambil data instruktur
        $instruktur = PelatihanMentor::where('sesi_pelatihans_id', $id_sesi)
            ->join('masterblk_db.users as u', 'u.email', 'pelatihan_mentors.mentors_email')
            ->select('u.nama_depan', 'u.nama_belakang', 'u.email')
            ->get();

        // $mataPelajaran = MataPelajaran::where('id', $request->mapel);

        if (Auth::user()->role->nama_role == 'adminblk' || Auth::user()->role->nama_role == 'verifikator') {
            $tugasPermataPelajaran = collect(TugasPeserta::where('sesi_pelatihans_id', $request->sesi)
                ->where('is_delete', 0)
                ->get()->toArray());
        } else {
            
            $tugasPermataPelajaran = TugasPeserta::tugasPeserta($id_sesi);
        }
        //ambil dari model tugas peserta
        $namaInstrukturPersesi = TugasPeserta::daftarInstrukturPersesiPelatihan($id_sesi);
        // dd($tugasPermataPelajaran);
        return view('pembelajaran.detailPelajaran', compact('instruktur', 'id_sesi', 'tugasPermataPelajaran', 'namaInstrukturPersesi'));
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
        //pengecekan apakah ada yg sama dan perlu diisi
        $this->validate($request, [
            'topik' => ['required', 'string', Rule::unique('mandira.tugas_pesertas', 'topik')->ignore($request->topik, 'topik')],
            'judulTugas' => ['required', 'string', Rule::unique('mandira.tugas_pesertas', 'judul')->ignore($request->judulTugas, 'judul')],
            'detailPenugasan' => ['required', 'string', Rule::unique('mandira.tugas_pesertas', 'detail')->ignore($request->detailPenugasan, 'detail')],
            // 'tanggalAwalPengumpulan' => ['required', 'string', Rule::unique('mandira.tugas_pesertas', 'tanggal_buka')->ignore($request->tanggalAwalPengumpulan, 'tanggal_buka')],
            // 'tanggalAkhirPengumpulan' => ['required', 'string', Rule::unique('mandira.tugas_pesertas', 'tanggal_tutup')->ignore($request->tanggalAkhirPengumpulan, 'tanggal_tutup')],
        ]);
        $tugasPeserta = new TugasPeserta();
        $tugasPeserta->topik = $request->topik;
        $tugasPeserta->judul = $request->judulTugas;
        $tugasPeserta->detail = $request->detailPenugasan;
        $tugasPeserta->tanggal_buka = $request->tanggalAwalPengumpulan;
        $tugasPeserta->tanggal_tutup = $request->tanggalAkhirPengumpulan;

        // ambil dari parameter yg dikirim input type hidden
        $tugasPeserta->sesi_pelatihans_id = $request->sesi_pelatihan;
        

        if (Auth::user()->role->nama_role == 'adminblk') {
            $foto =  $request->file('bukti')->store('buktiTambahTugas');
            $tugasPeserta->bukti = $foto;
            $tugasPeserta->keterangan = $request->keterangan;
            $tugasPeserta->mentors_email = $request->namaInstruktur;
        } else {
            $tugasPeserta->mentors_email = Auth::user()->email;
            $tugasPeserta->bukti = "";
            $tugasPeserta->keterangan = "";
        }

        //ambil siapa yang login
        $tugasPeserta->created_by = Auth::user()->email;
        $tugasPeserta->save();
        //tidak back karena pakai query name yang sama untuk kirim data sehingga untuk back harus d request lagi
        return redirect()->route('tugasPeserta.index', ['sesi' => $request->sesi_pelatihan])->with('success', 'Tugas Peserta berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TugasPeserta  $tugasPeserta
     * @return \Illuminate\Http\Response
     */
    public function show(TugasPeserta $tugasPeserta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TugasPeserta  $tugasPeserta
     * @return \Illuminate\Http\Response
     */
    public function edit(TugasPeserta $tugasPeserta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TugasPeserta  $tugasPeserta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TugasPeserta $tugasPeserta)
    {
        //
        // dd($request->id);
        //try {
            if(Auth::user()->role->nama_role == 'verifikator'){
                $mentor_email = Auth::user()->email;

            }else{
                $mentor_email = $request->namaInstruktur;
            }
            $data = [
                'sesi_pelatihans_id' => $request->sesi_pelatihan,
                'mentors_email' => $mentor_email,
                'topik' => $request->topik,
                'judul' => $request->judulTugas,
                'detail' => $request->detailPenugasan,
                'tanggal_buka' => $request->tanggalAwalPengumpulan,
                'tanggal_tutup' => $request->tanggalAkhirPengumpulan,
                'keterangan' => $request->keterangan,
            ];
            if ($request->bukti) {
                $data['bukti'] = $request->bukti;
            }
            TugasPeserta::where('id', $request->id)
                ->update($data);
            return redirect()->back()->with('success', 'Data tugas berhasil diubah!');
        // } catch (\Exception $e) {
        //     $msg = "Data gagal diupdate. Pastikan data belum pernah diinputkan sebelumnya";

        //     return redirect()->back()->with('error', $msg);
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TugasPeserta  $tugasPeserta
     * @return \Illuminate\Http\Response
     */
    public function destroy(TugasPeserta $tugasPeserta, Request $request)
    {
        //

        $data = TugasPeserta::where('id', $request->id)
            ->update(['is_delete' => 1]);

        // try {
        // $tugasPeserta->is_delete = 1;
        // $tugasPeserta->save();
        return redirect()->back()->with('success', 'Data tugas berhasil dihapus!');
        // } catch (\PDOException $e) {
        //     $msg = "Data gagal dihapus";

        //     return redirect()->back()->with('error', $msg);
        // }
    }

    public function kumpulTugasPeserta(Request $request)
    {
    }
}
