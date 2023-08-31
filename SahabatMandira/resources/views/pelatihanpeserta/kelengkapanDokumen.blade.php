@extends('layouts.adminlte')

@section('title')
Kelengkapan Dokumen
@endsection


@section('contents')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card-kelengkapan">
            <div class="card-header">
                <h1>Kelengkapan Dokumen Peserta</h1>
            </div>

            <div class="portlet-body form">
                @foreach($data as $d )
                <form role='form' method="POST" enctype="multipart/form-data" action="{{url('User/'.$d->email)}}">
                    @csrf
                    @method('PUT')
                    <div class="form-body">

                        <div class="form-group">
                            <label for="jenisIdentitas" class="col-md-12 col-form-label">{{ __('Jenis Identitas') }}</label>
                            <div class="col-md-12">
                                <select class="form-control" aria-label="Default select example" name="jenis_identitas" required>
                                    <option value="KTP">KTP</option>
                                    <option value="Pasport">Pasport</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nomorIdentitas" class="col-md-12 col-form-label">{{ __('Nomor Identitas') }}</label>

                            <div class="col-md-12">
                                <input id="nomorIdentitas" type="text" class="form-control @error('nomorIdentitas') is-invalid @enderror" name="nomor_identitas" required autocomplete="nomorIdentitas" autofocus>

                                @error('nomorIdentitas')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nomorHp" class="col-md-12 col-form-label">{{ __('Nomor Hp') }}</label>
                            <div class="col-md-12">
                                <input id="nomorHp" type="text" class="form-control @error('nomorHp') is-invalid @enderror" name="nomer_hp" required autocomplete="nomorHp" autofocus>

                                @error('nomorHp')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                        </div>

                        <div class="form-group">
                        <label for="tempatLahir" class="col-md-12 col-form-label">{{ __('Tempat Lahir') }}</label>
                            <input id="tempatLahir" type="text" class="form-control @error('tempatLahir') is-invalid @enderror" name="tempatLahir" value="{{ old('tempatLahir') }}" required autocomplete="tempatLahir" autofocus>
                            @error('tempatLahir')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group">
                        <label for="tanggalLahir" class="col-md-12 col-form-label">{{ __('Tangal Lahir') }}</label>

                            <input id="tanggalLahir" type="date" class="form-control @error('tanggalLahir') is-invalid @enderror" name="tanggalLahir" value="{{ old('tanggalLahir') }}" required autocomplete="tanggalLahir" autofocus>

                            @error('tanggalLahir')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                        <div class="form-group">
                            <label for="kota" class="col-md-12 col-form-label">{{ __('Alamat Domisili') }}</label>

                            <div class="col-md-12">
                                <input id="kota" type="text" class="form-control @error('kota') is-invalid @enderror" name="kota" required autocomplete="kota" autofocus>

                                @error('kota')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="alamat" class="col-md-12 col-form-label">{{ __('Alamat Sesuai KTP') }}</label>

                            <div class="col-md-12">
                                <input id="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" required autocomplete="alamat" autofocus>

                                @error('alamat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pas_foto" class="col-md-12 col-form-label">{{ __('Pas Foto') }}</label>

                            <input type="file" name='pas_foto' class="defaults" value="" required>
                        </div>
                        <div class="form-group">
                            <label for="fotoKtp" class="col-md-12 col-form-label">{{ __('Dokumen KTP') }}</label>

                            <input type="file" name='fotoKtp' class="defaults" value="" required>
                        </div>

                        <div class="form-group">
                            <label for="ksk" class="col-md-12 col-form-label">{{ __('Dokumen KSK') }}</label>

                            <input type="file" name='ksk' class="defaults" value="" required>
                        </div>

                        <div class="form-group">
                            <label for="ijazah" class="col-md-12 col-form-label">{{ __('Dokumen Ijazah') }}</label>

                            <input type="file" name='ijazah' class="defaults" value="" required>
                        </div>

                        <div class="form-group">
                            <label for="nama" class="col-md-12 col-form-label">{{ __('Jenis Kelamin') }}</label>
                            <div class="col-md-12">
                                <select class="form-control" aria-label="Default select example" name="jenis_kelamin" required>
                                    <option value="Laki-Laki">Laki-Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nama" class="col-md-12 col-form-label">{{ __('Pendidikan Terakhir') }}</label>
                            <div class="col-md-12">
                                <select class="form-control" aria-label="Default select example" name="pendidikan_terakhir" required>
                                    <option value="SD Sederajat">SD Sederajat</option>
                                    <option value="SMP Sederajat">SMP Sederajat</option>
                                    <option value="SMA Sederajat">SMA</option>
                                    <option value="SMK Sederajat">SMK</option>
                                    <option value="D1/D2/D3/D4">Diploma (D1/D2/D3/D4)</option>
                                    <option value="Sarjana(Strata-1)">Sarjana(S1)</option>
                                    <option value="Pasca Sarjana">Pasca Sarjana</option>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="idPelatihan" value="{{ $idpelatihan }}">
                        <div class="form-group form-button">
                            <div class="row">
                                <div class="col-md-6 pull-right">
                                    <a class="col-md-6 btn btn-secondary" href="{{ route('home') }}">
                                        {{ __('Batal') }}
                                    </a>
                                </div>
                                <div class="col-md-6 pull-left">
                                    <button type="submit" class="col-md-6 btn btn-primary">
                                        {{ __('Simpan') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                @endforeach
            </div>

        </div>
    </div>
</div>
@endsection