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

@if(Auth::user()->role->nama_role == 'user')
    @foreach($ditawarkan as $d)
        <div class="col-sm-3 float-left">
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
                {{ $d->paketProgram->subkejuruan->nama }}
                </div>
                <div class="card-footer">
                    <a data-toggle="modal" data-target="#modalTambahInstruktur" class='btn btn-warning '>
                        detail
                    </a>
                </div>
            </div>
        </div>
    @endforeach
@endif

@endsection