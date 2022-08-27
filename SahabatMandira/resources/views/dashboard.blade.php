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
<br>

@if(Auth::user()->role->nama_role == 'peserta')
<div>
    <div class="col-sm-6">
        <h2 class="m-0 text-dark">PROGRAM PELATIHAN</h1><br>
            <h5>Berikut adalah program pelatihan yang disarankan untuk diikuti</h5>
    </div>
    <div class="col-sm-3">
        @foreach($ditawarkan as $d)
        <div class="card card-primary">
            <div class="ribbon-wrapper">
                <div class="ribbon bg-primary">
                    {{ $d->paketProgram->blk->nama }}
                </div>
            </div>
            <div class="card-header">
                <h3 class="card-title">{{ $d->paketProgram->kejuruan->nama }}</h3>
            </div>
            <div class="card-body">
                <h1>GAMBAR KEJURUAN</h1>
            </div>
            <div class="card-body">
                {{ $d->paketProgram->subkejuruan->nama }}
            </div>
            <div class="card-body">
                <h5>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore
                    et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                    aliquip
                    ex ea commodo consequat.</h5>
            </div>
            <div class="card-footer">
                <a href="{{url('sesiPelatihan/'.$d->id)}}" class="button btn btn-primary">{{ __('DETAIL') }}</a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif

<br>

<div class="">
    <div class="col-sm-6">
        <h2 class="m-0 text-dark">PROGRAM PELATIHAN YANG DITAWARKAN</h1><br>
            <h5>Berikut adalah program pelatihan yang ditawarkan</h5><br>
    </div>
    <div class="col-sm-3">
        @foreach($ditawarkan as $d)
        <div class="card card-primary ">
            <div class="ribbon-wrapper">
                <div class="ribbon bg-primary">
                    {{ $d->paketProgram->blk->nama }}
                </div>
            </div>
            <div class="card-header">
                <h3 class="card-title">{{ $d->paketProgram->kejuruan->nama }}</h3>
            </div>
            <div class="card-body">
                <h1>GAMBAR KEJURUAN</h1>
            </div>
            <div class="card-body">
                {{ $d->paketProgram->subkejuruan->nama }}
            </div>
            <div class="card-body">
                <h5>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore
                    et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                    aliquip
                    ex ea commodo consequat.</h5>
            </div>
            <div class="card-footer">
                <a href="{{url('sesiPelatihan/'.$d->id)}}" class="button btn btn-primary">{{ __('DETAIL') }}</a>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection
