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

<div class="modal fade" id="modalDetailKerja" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" id="modalContent">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Kerja</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="col-md-12 text-center">
                        <img src="gambar4.jpg" class="col-md-12 card-img-top">
                        <label for="nama" class="col-md-12 col-form-label">{{__('Nama Perusahaan')}}</label>
                    </div>
                </div>

                {{--<div class="form-group">
                    @foreach($data_lowongan as $dl)
                    <div class="col-md-12">
                        <label for="label" class="col-md-12 col-form-label">{{__('Posisi')}}</label>
                <p class="col-md-12">{{$dl->posisi}}</p>
                <label for="label" class="col-md-12 col-form-label">{{__('Alamat')}}</label>
                <p class="col-md-12">{{$dl->alamat}}</p>
                <label for="label" class="col-md-12 col-form-label">{{__('Gaji')}}</label>
                <p class="col-md-12">{{$dl->gaji}}</p>
                <label for="label" class="col-md-12 col-form-label">{{__('Jam Kerja')}}</label>
                <p class="col-md-12">{{$dl->jam_kerja}}</p>
                <label for="label" class="col-md-12 col-form-label">{{__('Deskripsi Pekerjaan')}}</label>
                <p class="col-md-12">{{$dl->deskripsi_kerja}}</p>
                <label for="label" class="col-md-12 col-form-label">{{__('Profile Perusahaan')}}</label>
                <p class="col-md-12">{{$dl->profile_perusahaan}}</p>
            </div>
            @endforeach
        </div>--}}

        <div class="form-group">
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Daftar</button>
            </div>
        </div>
    </div>
</div>
</div>
</div>

@if(Auth::user()->role->nama_role == 'peserta')
<div class="col-sm-6">
    <h1 class="m-0 text-dark">BURSA KERJA</h1><br>
    <h5>Bursa kerja untuk para pencari kerja</h5>
</div>

<div class="col-sm-3 float-left">
    <div class="card card-primary ">
        <div class="card-header">
            <h3 class="card-title">Nama Perusahaan</h3>
        </div>
        <div class="card-body">
            <h1>LOGO</h1>
        </div>
        <div class="card-body">
            <h5>Posisi</h5>
        </div>
        <div class="card-body">
            <small>Tanggal Pemasangan</small>
        </div>
        <div class="card-footer">
            <a data-toggle="modal" data-target="#modalTambahInstruktur" class='btn btn-primary '>
                Detail
            </a>
        </div>
    </div>
</div>
@endif

{{--<div class="form-group mb-0 rata_tengah">
    <div class="col-md-12 offset-manual text-right">
        <label for="daftar" class="col-md-12 col-form-label">{{ __('Daftar sebagai perusahaan!') }}</label>
<a href="{{url('menu/perusahaan/create')}}" class="button btn btn-primary">{{ __('DAFTAR') }}</a>
</div>
</div>--}}


@endsection
