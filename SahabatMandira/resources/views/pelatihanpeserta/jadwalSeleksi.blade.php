@extends('layouts.adminlte')

@section('title')
PELATIHAN PESERTA
@endsection

@section('contents')
<div class="col-sm-6">
    <h2 class="m-0 text-dark">Jadwal dan Lokasi Seleksi</h2><br>
</div>
@foreach($data as $d)
<div class="col-sm-3">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">{Success</h3>
        </div>

        <div class="card-body">
            <h2>Jadwal Seleksi :</h2>
            {{ $d->tanggal_seleksi }}
        </div>
        <div class="card-body">
            <h2>Alamat Seleksi :</h2>
            {{ $d->lokasi}}
        </div>
    </div>
</div>
@endforeach
@endsection
