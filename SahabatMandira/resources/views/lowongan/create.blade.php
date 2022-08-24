@extends('layouts.adminlte')

@section('title')
Lowongan
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
                <h4>Lowongan</h4>
            </div>
            @if (\Session::has('success'))
            <div class="alert alert-success">
                <ul>
                    <li>{!! \Session::get('success') !!}</li>
                </ul>
            </div>
            @endif

            <div class="card-body">
                <form method="POST" action="{{ route('lowongan.store') }}">
                    @csrf

                    <div class="form-group">
                        <label for="jabatan" class="col-md-12 col-form-label">{{ __('Jabatan atau Posisi') }}</label>

                        <div class="col-md-12">
                            <input id="jabatan" type="text" class="form-control @error('jabatan') is-invalid @enderror"
                                name="jabatan" value="{{ old('jabatan') }}" required autocomplete="nama" autofocus>

                            @error('jabatan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="pengalamanKerja" class="col-md-12 col-form-label">{{ __('Pengalaman Kerja') }}</label>

                        <div class="col-md-12">
                            <input id="pengalamanKerja" type="text" class="form-control @error('pengalamanKerja') is-invalid @enderror"
                                name="pengalaman_kerja" value="{{ old('pengalamanKerja') }}" required autocomplete="pengalamanKerja" autofocus>

                            @error('pengalamanKerja')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="lokasi" class="col-md-12 col-form-label">{{ __('Lokasi Pekerjaan') }}</label>

                        <div class="col-md-12">
                            <input id="lokasi" type="text" class="form-control @error('lokasi') is-invalid @enderror"
                                name="lokasi" value="{{ old('lokasi') }}" required autocomplete="lokasi" autofocus>

                            @error('lokasi')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="gaji" class="col-md-12 col-form-label">{{ __('Gaji') }}</label>

                        <div class="col-md-12">
                            <input id="gaji" type="number" class="form-control @error('gaji') is-invalid @enderror"
                                name="gaji" value="{{ old('gaji') }}" required autocomplete="gaji" autofocus>

                            @error('gaji')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="pendidikanTerakhir" class="col-md-12 col-form-label">{{ __('Pendidikan Terakhir') }}</label>

                        <div class="col-md-12">
                            <input id="pendidikanTerakhir" type="text" class="form-control @error('pendidikanTerakhir') is-invalid @enderror"
                                name="pendidikan_terakhir" value="{{ old('pendidikanTerakhir') }}" required autocomplete="pendidikanTerakhir" autofocus>

                            @error('pendidikanTerakhir')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="jamKerja" class="col-md-12 col-form-label">{{ __('Jam Kerja') }}</label>

                        <div class="col-md-12">
                            <input id="jamKerja" type="time" class="form-control @error('jamKerja') is-invalid @enderror"
                                name="jam_kerja" value="{{ old('jamKerja') }}" required autocomplete="jamKerja" autofocus>

                            @error('jamKerja')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="deskripsiPekerjaan" class="col-md-12 col-form-label">{{ __('Deskripsi Pekerjaan') }}</label>

                        <div class="col-md-12">
                            <textarea name="deskripsi_pekerjaan" class="form-control" rows="3" required></textarea>

                            @error('deskripsiPekerjaan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="profilPerusahaan" class="col-md-12 col-form-label">{{ __('Profil Perusahaan') }}</label>

                        <div class="col-md-12">
                            <textarea name="profil_perusahaan" class="form-control" rows="3" required></textarea>

                            @error('profilPerusahaan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <p>
                            <span class="label label-danger">NOTE!</span>
                            Upload semua dokumen dalam bentuk .JPG, .PNG atau .PDF
                        </p>

                        <div class="form-group">
                            <label for="pas_foto">Logo Perusahaan</label>
                            
                            <input type="file" name='logo' class="defaults" value="{{ $data->logo ?? ''}}" required>
                        </div>

                        <div class="form-group">
                            <label for="foto">Foto Perusahaan</label>
                            
                            <input type="file" name='foto' class="defaults" value="{{ $data->foto ?? ''}}" required>
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