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

                <div class="form-group">
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
                </div>

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

<div class="card-deck">
    @foreach($data as $d)
    <div class="card">
        <img src="gambar4.jpg" class="card-img-top">
        <div class="card-body">
            <h5 class="card-title">{{$d->posisi}}</h5>
            <p class="card-text">{{$d->nama}}</p>
            <p class="card-text"><small class="text-muted">{{$d->tanggal_pemasangan}}</small></p>
            <div class="form-group mb-0 rata_tengah">
                <div class="col-md-12 offset-manual text-right">
                    <a data-toggle="modal" data-target="#modalDetailKerja" class='btn btn-primary'>Detail</a>
                    <br>
                </div>
            </div>
        </div>
        {{--<a data-toggle="modal" data-target="#modalDetailKerja" class='btn btn-warning' onclick="modalEdit({{$d->id}})">
        <i class="fas fa-pen"></i></a>--}}
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