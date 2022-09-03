@extends('layouts.adminlte')

@section('title')
PELATIHAN PESERTA
@endsection

@section('contents')
<div class="col-sm-6">
    <h2 class="m-0 text-dark">Jadwal dan Lokasi Seleksi</h2><br>
</div>

<div class="col-sm-3">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">SUKSES</h3>
        </div>

        <div class="card-body">
            <h2>Jadwal Seleksi :</h2>
            {{ $data->tanggal_seleksi }}
        </div>
        <div class="card-body">
            <h2>Alamat Seleksi :</h2>
            {{ $data->lokasi}}
        </div>
    </div>
</div>

@endsection
