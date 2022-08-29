@extends('layouts.adminlte')

@section('title')
Pelatihan Peserta
@endsection


@section('contents')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card-kelengkapan">
            <div class="card-header">
                <p>Kelengkapan Dokumen</p>
            </div>

            <div class="portlet-body form">
                @foreach($data as $d )
                <form role='form' method="POST" enctype="multipart/form-data" action="{{url('user/'.$d->email)}}">
                    @csrf
                    <div class="form-body">
                        <div class="form-group">
                            <label for="pas_foto" class="col-md-12 col-form-label">{{ __('Pas Foto') }}</label>

                            <input type="file" name='pas_foto' class="defaults" value="" required>
                        </div>

                        <div class="form-group">
                            <label for="jenisIdentitas"
                                class="col-md-12 col-form-label">{{ __('Jenis Identitas') }}</label>
                            <div class="col-md-3">
                                <select class="form-control" aria-label="Default select example" name="jenis_identitas"
                                    required>
                                    <option value="KTP">KTP</option>
                                    <option value="Pasport">Pasport</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="no_identitas"
                                class="col-md-12 col-form-label">{{ __('Nomor Identitas') }}</label>

                            <input type="text" name='no_identitas' class="defaults" value="" required>
                        </div>
                        <div class="form-group">
                            <label for="no_hp" class="col-md-12 col-form-label">{{ __('Nomor Hp') }}</label>

                            <input type="text" name='no_hp' class="defaults" value="" required>
                        </div>
                        <div class="form-group">
                            <label for="pas_foto" class="col-md-12 col-form-label">{{ __('Kota') }}</label>

                            <input type="text" name='kota' class="defaults" value="" required>
                        </div>

                        <div class="form-group">
                            <label for="pas_foto" class="col-md-12 col-form-label">{{ __('Alamat') }}</label>

                            <input type="text" name='alamat' class="defaults" value="" required>
                        </div>

                        <div class="form-group">
                            <label for="ktp" class="col-md-12 col-form-label">{{ __('Dokumen KTP') }}</label>

                            <input type="file" name='no_ktp' class="defaults" value="" required>
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
                            <div class="col-md-3">
                                <select class="form-control" aria-label="Default select example" name="jenis_kelamin"
                                    required>
                                    <option value="Laki-Laki">Laki-Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nama" class="col-md-12 col-form-label">{{ __('Pendidikan Terakhir') }}</label>
                            <div class="col-md-3">
                                <select class="form-control" aria-label="Default select example"
                                    name="pendidikan_terakhir" required>
                                    <option value="SD Sederajat">SD Sederajat</option>
                                    <option value="SMP Sederajat">SMP Sederajat</option>
                                    <option value="SMA Sederajat">SMA Sederajat</option>
                                    <option value="S1">S1</option>
                                    <option value="Pasca Sarjana">Pasca Sarjana</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group form-button">
                            <div class="row">
                                <div class="col-md-6 pull-right">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Submit') }}
                                    </button>
                                </div>

                                <div class="col-md-6 pull-left">
                                    <a class="col-md-8 btn btn-primary" href="{{ route('home') }}">
                                        {{ __('Back') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                @endforeach
            </div>

        </div>
        @endsection
