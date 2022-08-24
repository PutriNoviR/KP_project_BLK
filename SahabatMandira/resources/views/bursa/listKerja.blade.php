@extends('layouts.adminlte')

@section('title')
Bursa Kerja
@endsection

@section('page-bar')
<div class="col-sm-6">
    <h1 class="m-0 text-dark">Dashboard</h1>
</div><!-- /.col -->
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Bursa Kerja</li>
    </ol>
</div><!-- /.col -->
@endsection

@section('contents')

<div class="card-deck">
  @foreach($data as $d)
  <div class="card">
    <img src="gambar4.jpg" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">{{$d->posisi}}</h5>
      <p class="card-text">{{$d->nama}}</p>
      <p class="card-text"><small class="text-muted">{{$d->tanggal_pemasangan}}</small></p>
    </div>
  </div>
  @endforeach
</div>

<div class="form-group mb-0 rata_tengah">
    <div class="col-md-12 offset-manual text-right">
        <label for="daftar" class="col-md-12 col-form-label">{{ __('Daftar sebagai perusahaan!') }}</label>
        <a href="{{url('menu/perusahaan/create')}}" class="button btn btn-primary">{{ __('DAFTAR') }}</a>
    </div>
</div>
@endsection