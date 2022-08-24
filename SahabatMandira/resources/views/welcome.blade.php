@extends('layouts.adminlte')

@section('title')
Dashboard
@endsection

@section('page-bar')
<div class="col-sm-6">
    <h1 class="m-0 text-dark">Dashboard</h1>
</div><!-- /.col -->
@endsection

@section('contents')
<div class="form-group mb-0 rata_tengah">
    <div class="col-md-12 offset-manual">
        <a href="{{url('menu/bursa/listKerja')}}" class="button btn btn-primary">{{ __('BURSA KERJA') }}</a>
    </div>
</div>

{{--<div class="card-deck">
    @foreach($lowongan as $data)
  <div class="card">
    <img src="gambar4.jpg" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">{{$data->posisi}}</h5>
      @foreach($lowongan->find($data->id)->perusahaan() as $data1)
      <p class="card-text">{{$data1->nama}}</p>
      @endforeach
      <p class="card-text"><small class="text-muted">{{$data->tanggal_pemasangan}}</small></p>
    </div>
  </div>
  @endforeach
</div>--}}      

@endsection
