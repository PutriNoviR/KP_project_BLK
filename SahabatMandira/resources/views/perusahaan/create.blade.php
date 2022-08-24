@extends('layouts.adminlte')

@section('title')
Perusahaan
@endsection

@section('page-bar')
<div class="col-sm-6">
    <h1 class="m-0 text-dark">Dashboard</h1>
</div><!-- /.col -->
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Perusahaan</li>
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
                <form method="POST" enctype="multipart/form-data" action="{{ route('perusahaan.store') }}">
                    @csrf

                    <div class="form-group">
                        <label for="nama" class="col-md-12 col-form-label">{{ __('Nama Perusahaan') }}</label>

                        <div class="col-md-12">
                            <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror"
                                name="nama" value="{{ old('nama') }}" required autocomplete="nama" autofocus>

                            @error('nama')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="bidang" class="col-md-12 col-form-label">{{ __('Bidang') }}</label>

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
                        <label for="alamat" class="col-md-12 col-form-label">{{ __('Alamat') }}</label>

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
                        <label for="kodePos" class="col-md-12 col-form-label">{{ __('Kode Pos') }}</label>

                        <div class="col-md-12">
                            <input id="kodePos" type="text" class="form-control @error('kodePos') is-invalid @enderror"
                                name="kode_pos" value="{{ old('kodePos') }}" required autocomplete="kodePos" autofocus>

                            @error('kodePos')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nomorTelp" class="col-md-12 col-form-label">{{ __('Nomor Telepon') }}</label>

                        <div class="col-md-12">
                            <input id="nomorTelp" type="text" class="form-control @error('nomorTelp') is-invalid @enderror"
                                name="no_telp" value="{{ old('nomorTelp') }}" required autocomplete="nomorTelp" autofocus>

                            @error('nomorTelp')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="col-md-12 col-form-label">{{ __('Email') }}</label>

                        <div class="col-md-12">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="tentangPerusahaan" class="col-md-12 col-form-label">{{ __('Tentang Perusahaan') }}</label>

                        <div class="col-md-12">
                            <textarea name="tentang_perusahaan" class="form-control" rows="3" required></textarea>

                            @error('tentangPerusahaan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <p>
                            <span class="col-md-12 label label-danger">NOTE!</span>
                            Upload semua dokumen dalam bentuk .JPG, .PNG atau .PDF
                        </p>

                        <div class="form-group">
                            <label class="col-md-12" for="pas_foto">Logo Perusahaan</label>
                            
                            <input type="file" name='logo' class="col-md-12 defaults" required>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12" for="foto">Foto Perusahaan</label>
                            
                            <input type="file" name='images' class="col-md-12 defaults" required>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12" for="siup">SIUP</label>
                            
                            <input type="file" name='siup' class="col-md-12 defaults" required>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12" for="npwp">NPWP</label>
                            
                            <input type="file" name='npwp' class="col-md-12 defaults" required>
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
