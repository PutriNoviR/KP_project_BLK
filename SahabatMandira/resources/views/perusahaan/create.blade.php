@extends('layouts.adminlte')

@section('title')
BLK
@endsection

@section('page-bar')
<div class="col-sm-6">
    <h1 class="m-0 text-dark">Dashboard</h1>
</div><!-- /.col -->
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Dashboard v1</li>
    </ol>
</div><!-- /.col -->
@endsection

@section('contents')
<div class="row justify-content-center">

    <div class="col-md-8">
        <div class="card-register">
            <div class="card-header">
                <h4>Profil Perusahaan</h4>
            </div>
            @if (\Session::has('success'))
            <div class="alert alert-success">
                <ul>
                    <li>{!! \Session::get('success') !!}</li>
                </ul>
            </div>
            @endif

            <div class="card-body">
                <form method="POST" action="{{ route('perusahaan.store') }}">
                    @csrf

                    <div class="form-group">
                        <label for="nama" class="col-md-12 col-form-label">{{ __('Nama Perusahaan') }}</label>

                        <div class="col-md-12">
                            <input id="nama" type="nama" class="form-control @error('email') is-invalid @enderror"
                                name="nama" value="{{ old('nama') }}" required autocomplete="nama" autofocus>

                            @error('nama')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="alamat" class="col-md-12 col-form-label">{{ __('Bidang') }}</label>

                        <div class="col-md-12">
                            <input id="bidang" type="text" class="form-control @error('bidang') is-invalid @enderror"
                                name="bidang" value="{{ old('bidang') }}" required autocomplete="bidang" autofocus>

                            @error('bidang')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="website" class="col-md-12 col-form-label">{{ __('Alamat') }}</label>

                        <div class="col-md-12">
                            <input id="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror"
                                name="alamat" value="{{ old('alamat') }}" required autocomplete="alamat" autofocus>

                            @error('alamat')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="memilikiSistem" class="col-md-12 col-form-label">{{ __('Memiliki Sistem') }}</label>

                        <div class="col-md-12">
                            <select class="form-select" aria-label="Default select example" name="is_punyasistem">
                                <option value="1">YA</option>
                                <option value="0">Tidak</option>
                            </select>

                            @error('memilikiSistem')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="linkPendaftaran"
                            class="col-md-12 col-form-label">{{ __('Link Pendaftaran') }}</label>

                        <div class="col-md-12">
                            <input id="linkPendaftaran" type="text"
                                class="form-control @error('linkPendaftaran') is-invalid @enderror"
                                name="link_pendaftaran" value="{{ old('linkPendaftaran') }}" required
                                autocomplete="linkPendaftaran" autofocus>

                            @error('linkPendaftaran')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group mb-0 rata_tengah">
                        <div class="col-md-12 offset-manual">
                            <button type="submit" class="btn btn-primary">
                                {{ __('SIMPAN') }}
                            </button>
                            <br>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection
