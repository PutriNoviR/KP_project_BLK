@extends('layouts.adminlte')

@section('title')
PELATIHAN
@endsection

@section('contents')
<div style="margin:auto;">
    <div class="col-sm-6">
        <h2 class="m-0 text-dark">Detail Program Pelatihan mentor</h2><br>
    </div>
    @foreach($data as $d)
    <div class="col-sm-8">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">{{ $d->nama_program }}</h3>
            </div>

            <div class="card-body">
                <h2>Nama Program Mentoring :</h2>
                <h4>{{ $d->nama_program }}</h4>
            </div>
            <div class="card-body">
                <h2>Deskripsi :</h2>
                <h4>{{ $d->deskripsi_program }}</h4>
            </div>
            <div class="card-body">
                <h2>Periode Pendaftaran :</h2>
                <h4>{{$d->tgl_dibuka}} - {{$d->tgl_ditutup}}</h4>
            </div>
            <div class="card-body">
                <h2>LINK PENDAFTARAN PELATIHAN :</h2>
                <h4><a href="{{ url($d->link_pendaftaran) }}">KLIK LINK INI UNTUK MELAKUKAN PENDAFTARAN</a></h4>
            </div>
            
        </div>
    </div>
</div>
@endforeach
@endsection