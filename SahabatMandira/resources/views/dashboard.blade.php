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

@endsection
