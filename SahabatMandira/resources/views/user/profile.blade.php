@extends('layouts.adminlte')

@section('title')
Profile
@endsection

@section('page-bar')
@endsection

@section('contents')

<div class="content mt-2">
    <!-- START JUMBOTRON -->
    <div class="jumbotron" data-pages="parallax">
        <div class="container-fluid p-l-25 p-r-25 sm-p-l-0 sm-p-r-0">
            <div class="row row m-b-40">
                <div class="col-xl-3 col-lg-4 ">
                    <!-- START card -->
                    <div class="">
                        <div class="card-body text-center">
                            <img class="image-responsive-width" style="height: 90%; width: 90%;" src="{{ asset('storage/logo/default.png') }}" alt="">
                        </div>
                    </div>
                    <!-- END card -->
                </div>
                <div class="col-xl-9 col-lg-8 ">
                    <!-- START card -->
                    <div class="card card-transparent">
                        <div class="card-body">
                            <p class="overline">Data Pribadi</p>
                            <h2>{{ $data->nama_depan }} {{ $data->nama_belakang }}</h2>

                            <p><br></p>

                            <br>
                            <div>
                                <div class="m-t-20">
                                    <p class=""></p>
                                    <p class=""><i class="fa fa-copy ml-1" id="copy-pinkrs" style="cursor: pointer;" title="Salin"></i></p>
                                    <input type="hidden" value="" id="pinkrs">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END card -->
                </div>
            </div>
        </div>
    </div>
    <!-- END JUMBOTRON -->

    <!-- SHOW ERROR MESSAGE -->
    <!-- END SHOW ERROR MESSAGE -->

    <div class="container-fluid container-fixed-lg ">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card card-transparent">
                    <!-- START card -->
                    <div class="card card-default">
                        <div class="card-header ">
                            <div class="card-title">
                            </div>
                        </div>
                        <div class="card-body">
                            <h4>Data Pribadi</h4>
                            <p class="m-t-10 m-b-20 text-justify"></p>
                            <form role='form' method="POST" enctype="multipart/form-data" action="{{ route('user.profile.update') }}">
                                @csrf
                                <input type="hidden" name='type' value='peserta'>
                                
                                <div class="form-body">

                                    <div class="form-group">
                                        <label for="email" class="col-md-12 col-form-label">{{ __('Email') }}</label>
                                        <div class="col-md-12">
                                            <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" value="{{ $data->email }}" name="email" readonly autocomplete="email" autofocus>

                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <label for="nama" class="col-md-12 col-form-label">{{ __('Nama Depan') }}</label>

                                        <div class="col-md-12">
                                            <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror" value="{{ $data->nama_depan }}" name="nama_depan" required autocomplete="nama" autofocus>

                                            @error('nama')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="nama" class="col-md-12 col-form-label">{{ __('Nama Belakang') }}</label>

                                        <div class="col-md-12">
                                            <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror" value="{{ $data->nama_belakang }}" name="nama_belakang" required autocomplete="nama" autofocus>

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
                                            <input id="nik" type="text" class="form-control @error('nik') is-invalid @enderror" value="{{ $data->nomor_identitas }}" name="nik" required autocomplete="nik" autofocus>

                                            @error('nik')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="nomorHp" class="col-md-12 col-form-label">{{ __('Nomor Hp') }}</label>

                                        <div class="col-md-12">
                                            <input id="nomorHp" type="text" class="form-control @error('nomorHp') is-invalid @enderror" value="{{ $data->nomer_hp }}" name="nomorHp" required autocomplete="nomorHp" autofocus>

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
                                            <input id="domisili" type="text" class="form-control @error('domisili') is-invalid @enderror" value="{{ $data->alamat }}" name="domisili" required autocomplete="domisili" autofocus>

                                            @error('domisili')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="nama" class="col-md-12 col-form-label">{{ __('Jenis Kelamin') }}</label>
                                        <div class="col-md-12">
                                            <select class="form-control" aria-label="Default select example" name="jenis_kelamin" required>
                                                <!-- <option value="Laki-Laki">Laki-Laki</option>
                                                <option value="Perempuan">Perempuan</option> -->
                                                @foreach(["jenis_kelamin" => "Laki-laki","Perempuan"] AS $jenis => $j)
                                                <option value="{{ $j }}" {{ ( $data->jenis_kelamin === $j) ? 'selected' : '' }}>{{ $j }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="nama" class="col-md-12 col-form-label">{{ __('Pendidikan Terakhir') }}</label>
                                        <div class="col-md-12">
                                            <select class="form-control" aria-label="Default select example" name="pendidikan_terakhir" required>
                                                @foreach(["data_pendidikan" => "SD Sederajat","SMP Sederajat","SMA Sederajat","SMK Sederajat","D1/D2/D3/D4","Sarjana(Strata-1)","Pasca Sarjana"] AS $pendidikan => $p)
                                                <option value="{{ $p }}" {{ ( $data->pendidikan_terakhir === $p) ? 'selected' : '' }}>{{ $p }}</option>
                                                @endforeach
                                                <!-- <option value="SD Sederajat" {{ ( $data->pendidikan_terakhir === 'SD Sederajat') ? 'selected' : '' }} >SD Sederajat</option>
                                                <option value="SMP Sederajat" {{ ( $data->pendidikan_terakhir === 'SMP Sederajat') ? 'selected' : '' }} >SMP Sederajat</option>
                                                <option value="SMA Sederajat" {{ ( $data->pendidikan_terakhir === 'SMA Sederajat') ? 'selected' : '' }} >SMA Sederajat</option>
                                                <option value="S1" {{ ( $data->pendidikan_terakhir === 'S1') ? 'selected' : '' }} >S1</option>
                                                <option value="Pasca Sarjana" {{ ( $data->pendidikan_terakhir === 'Pasca Sarjana') ? 'selected' : '' }} >Pasca Sarjana</option> -->
                                            </select>
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
                                        <button type="submit" class="btn btn-primary">SIMPAN</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- END card -->
                </div>
            </div>
        </div>
    </div>
</div>

@endsection