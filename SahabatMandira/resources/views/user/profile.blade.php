@extends('layouts.adminlte')

@section('title')
Profile
@endsection

@section('page-bar')
@endsection

@section('contents')


@if(Auth::user()->role->nama_role == 'peserta')


<div class="container">
    <div class="col-sm-6">
        <h4 class="m-0 text-dark">Data Pribadi</h4><br>
        <p>Nama</p>
        <p>Pelatihan</p>
        <p>Status Pelatihan</p>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card-kelengkapan">
            <div class="portlet-body form">

                <form role='form' method="POST" enctype="multipart/form-data" action="">
                    @csrf
                    <div class="form-body">

                        <div class="form-group">
                            <label for="nama" class="col-md-12 col-form-label">{{ __('Nama') }}</label>

                            <div class="col-md-12">
                                <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" required autocomplete="nama" autofocus>

                                @error('nama')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nik" class="col-md-12 col-form-label">{{ __('NIK') }}</label>

                            <div class="col-md-12">
                                <input id="nik" type="text" class="form-control @error('nik') is-invalid @enderror" name="nik" required autocomplete="nik" autofocus>

                                @error('nik')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-md-12 col-form-label">{{ __('Email') }}</label>
                            <div class="col-md-12">
                                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="nomorHp" class="col-md-12 col-form-label">{{ __('Nomor Hp') }}</label>

                            <div class="col-md-12">
                                <input id="nomorHp" type="text" class="form-control @error('nomorHp') is-invalid @enderror" name="nomorHp" required autocomplete="nomorHp" autofocus>

                                @error('nomorHp')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="domisili" class="col-md-12 col-form-label">{{ __('Domisili') }}</label>

                            <div class="col-md-12">
                                <input id="domisili" type="text" class="form-control @error('domisili') is-invalid @enderror" name="domisili" required autocomplete="domisili" autofocus>

                                @error('domisili')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">SIMPAN</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection