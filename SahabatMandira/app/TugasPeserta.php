<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PembelajaranPeserta;
use App\JawabanTugasPeserta;
use Illuminate\Support\Facades\Auth;

class TugasPeserta extends Model
{
    protected $table = 'tugas_pesertas'; //nma table
    protected $connection = 'mandira';

    public $timestamps = false;

    public static function daftarInstrukturPersesiPelatihan($id_sesi)
    {
        $instrukturPerMataPelajaran = PembelajaranPeserta::join('masterblk_db.users as u', 'u.email', 'pelajaran_mentor_persesi.mentors_email')
            //->join('pelajaran_mentor_persesi as pmp', 'pmp.mentors_email', 'pelatihan_mentors.mentors_email')
            ->where('pelajaran_mentor_persesi.sesi_pelatihans_id', $id_sesi)
            //->where('pelajaran_mentor_persesi.mata_pelajaran_id', $id_mapel)
            ->select('u.nama_depan', 'u.nama_belakang', 'u.email')
            ->get();


        return $instrukturPerMataPelajaran;
    }

    public static function tugasPeserta($id)
    {

        $arrJawaban = [];
        $tugasPerMapel = [];
        $arrTugas = [];

        $tugas = TugasPeserta::join('pelatihan_pesertas as pp', 'pp.sesi_pelatihans_id', '=', 'tugas_pesertas.sesi_pelatihans_id')
            ->leftJoin('jawaban_tugas_pesertas as jtp', 'jtp.tugas_pesertas_id', '=', 'tugas_pesertas.id')
            //->leftJoin('jawaban_tugas_pesertas as jtp', function ($join) {
            //     $join->on('jtp.tugas_pesertas_id', '=', 'tugas_pesertas.id');
            //     $join->on('jtp.users_email', '=', 'pp.email_peserta');
            // })
            ->where('pp.email_peserta', Auth::user()->email)
            ->where('pp.sesi_pelatihans_id', $id)
            ->where('tugas_pesertas.is_delete',0)
            ->select('tugas_pesertas.*')
            ->distinct('tugas_pesertas.id')
            ->get();
        

        foreach ($tugas as $t) {
            $jawaban = JawabanTugasPeserta::where('tugas_pesertas_id', $t->id)->first();

            $arrTugas = [
                'id' => $t->id,
                'topik' => $t->topik,
                'judul' => $t->judul,
                'detail' => $t->detail,
                'tanggal_buka' => $t->tanggal_buka,
                'tanggal_tutup' => $t->tanggal_tutup,
                'bukti' => $t->bukti,
                'keterangan' => $t->keterangan,
                'created_by' => $t->created_by,
                'idJawaban' => $jawaban->id ?? null,
                'jawabanTertulis' => $jawaban->jawaban ?? null,
                'fileJawaban' => $jawaban->jawaban_file ?? null,
                'updated_at' => $jawaban->updated_at ?? null,
                'nilai' => $t->nilai,
                'idSesi' => $t->sesi_pelatihans_id
            ];
            array_push($tugasPerMapel, $arrTugas);
        }


        $tugasPermataPelajaran = collect($tugasPerMapel);
        // dd($tugasPermataPelajaran);
        return $tugasPermataPelajaran;
    }

    public static function tugasPesertaBagianAdmin($id, $status)
    {

        $arrJawaban = [];
        $tugasPerMapel = [];
        $arrTugas = [];

        $tugas = TugasPeserta::join('pelatihan_pesertas as pp', 'pp.sesi_pelatihans_id', '=', 'tugas_pesertas.sesi_pelatihans_id')
            // ->join('jawaban_tugas_pesertas as jtp','jtp.tugas_pesertas_id', '=','tugas_pesertas.id')
            ->leftJoin('jawaban_tugas_pesertas as jtp', function ($join) {
                $join->on('jtp.tugas_pesertas_id', '=', 'tugas_pesertas.id');
                $join->on('jtp.users_email', '=', 'pp.email_peserta');
            })
            ->where('tugas_pesertas.id', $id)
            ->where('pp.rekom_keputusan', 'LULUS')
            ->select('tugas_pesertas.*', 'pp.email_peserta', 'jtp.nilai')
            ->distinct('tugas_pesertas.id')
            ->get();



        //  dd($tugas);
        foreach ($tugas as $t) {
            $peserta = User::where('email', $t->email_peserta)->first();
            if ($status == 'terlambat') {
                $jawaban = JawabanTugasPeserta::where('tugas_pesertas_id', $t->id)
                    ->where('users_email', $t->email_peserta)
                    ->where('updated_at', '>', $t->tanggal_tutup)->first();
            } else if ($status == 'sudahMengumpulkan') {
                $jawaban = JawabanTugasPeserta::where('tugas_pesertas_id', $t->id)
                    ->where('users_email', $t->email_peserta)
                    //->whereNotNull(function($query) {                    
                    ->whereNotNull('updated_at')
                    ->first();
            } else if ($status == 'belumMengumpulkan') {
                $jawaban = JawabanTugasPeserta::where('tugas_pesertas_id', $t->id)
                    ->where('users_email', $t->email_peserta)
                    //->whereNull('updated_at')
                    ->first();
                //dd($jawaban);
            } else {
                $jawaban = JawabanTugasPeserta::where('tugas_pesertas_id', $t->id)
                    ->where('users_email', $t->email_peserta)->first();
            }

            $arrTugas = [
                'id' => $t->id,
                'topik' => $t->topik,
                'judul' => $t->judul,
                'detail' => $t->detail,
                'tanggal_buka' => $t->tanggal_buka,
                'tanggal_tutup' => $t->tanggal_tutup,
                'bukti' => $t->bukti,
                'keterangan' => $t->keterangan,
                'created_by' => $t->created_by,
                'idJawaban' => $jawaban->id ?? null,
                'jawabanTertulis' => $jawaban->jawaban ?? null,
                'fileJawaban' => $jawaban->jawaban_file ?? null,
                'updated_at' => $jawaban->updated_at ?? null,
                'namaLengkap' => $peserta->nama_depan . ' ' . $peserta->nama_belakang,
                'email_peserta' => $t->email_peserta,
                'nilai' => $t->nilai,
                'idSesi' => $t->sesi_pelatihans_id
            ];
            // dd($arrTugas);
            array_push($tugasPerMapel, $arrTugas);
        }

        $tugasPermataPelajaran = collect($tugasPerMapel);
        // dd($tugasPermataPelajaran);
        return $tugasPermataPelajaran;
       
    }
}
