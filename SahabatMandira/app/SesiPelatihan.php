<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SesiPelatihan extends Model
{
    protected $table = 'sesi_pelatihans';
    protected $connection = 'mandira'; //koneksi apababila tabel berada pada database yang berbeda

    public function paketprogram()
    {
        return $this->setConnection('mysql')->belongsTo('App\PaketProgram', 'paket_program_id', 'id');
    }

    public function statuspelatihanpeserta()
    {
        return $this->hasMany('App\StatusPelatihanPeserta', 'sesi_pelatihans_id', 'id');
    }

    public function pelatihanpeserta()
    {
        return $this->hasMany('App\PelatihanPeserta', 'sesi_pelatihans_id', 'id');
    }

    public function pelatihanmentor()
    {
        return $this->belongsToMany('App\User', 'mandira_db.pelatihan_mentors', 'sesi_pelatihans_id', 'mentors_email');
    }

    public $timestamps = false;

    public static function getDataPelatihan($userLogin)
    {
        $dataInstruktur = SesiPelatihan::join('pelatihan_mentors as P', 'sesi_pelatihans.id', '=', 'P.sesi_pelatihans_id')
            ->WHERE('P.mentors_email', '=', $userLogin)
            ->where('sesi_pelatihans.is_delete', 0)
            ->get();

        $arr = [];
        foreach ($dataInstruktur as $i => $d) {

            $checkStatusPeserta = PelatihanPeserta::Where('sesi_pelatihans_id', $d->id)
                ->Where('rekom_keputusan', 'CADANGAN')
                ->orWhere('rekom_keputusan', 'NULL')
                ->count();
            $arrPelatihan = [
                'nomor' => $i + 1,
                'namaBlk' => $d->paketprogram->blk->nama,
                'namaKejuruan' => $d->paketprogram->kejuruan->nama,
                'namaSubKejuruan' => $d->paketprogram->subkejuruan->nama,
                'tanggalBukaPendaftaran' => $d->tanggal_pendaftaran,
                'tanggalTutupPendaftaran' => $d->tanggal_tutup,
                'lokasi' => $d->lokasi,
                'kuota' => $d->kuota,
                'tanggalSeleksi' => $d->tanggal_seleksi,
                'idSesi' => $d->id,
                'status' => $checkStatusPeserta
            ];
            array_push($arr, $arrPelatihan);
        }
        return $arr;
    }
}
