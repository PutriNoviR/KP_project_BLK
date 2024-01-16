@extends('layouts.adminlte')
@section('style')
    <style>
        .ck-editor__editable_inline {
            min-height: 200px;
        }
    </style>
@endsection
@section('javascript')
    <script>
        $(function() {
            ClassicEditor
                .create(document.querySelector('#tentang_perusahaan'))
                .catch(error => {
                    console.error(error);
                });
        });

        $('#logo').on('change', function() {
            //get the file name
            var fileName = $(this).val().replace('C:\\fakepath\\', " ");
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        });
    </script>
@endsection

@section('contents')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Masukkan Data Perusahaan</h4>
                    </div>

                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data" action="{{ route('perusahaan.store') }}">
                            @csrf
                            <div id="perusahaan">
                                <div class="form-group">
                                    <label for="nama"
                                        class="col-md-12 col-form-label">{{ __('Nama Perusahaan') }}</label>

                                    <div class="col-md-12">
                                        <input id="namaperusahaan" type="text"
                                            class="form-control @error('namaperusahaan') is-invalid @enderror"
                                            name="namaperusahaan" value="{{ old('namaperusahaan') }}"
                                            autocomplete="namaperusahaan" autofocus>

                                        @error('namaperusahaan')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="bidang" class="col-md-12 col-form-label">{{ __('Bidang') }}</label>

                                    <div class="col-md-12">
                                        <input id="bidang" type="text"
                                            class="form-control @error('bidang') is-invalid @enderror" name="bidang"
                                            value="{{ old('bidang') }}" autocomplete="bidang" autofocus>

                                        @error('bidang')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="kota" class="col-md-12 col-form-label">{{ __('Kota') }}</label>

                                        <div class="col-md-12">
                                            <input id="kota" type="text"
                                                class="form-control @error('kota') is-invalid @enderror" name="kota"
                                                value="{{ old('kota') }}" autocomplete="kota" autofocus>

                                            @error('kota')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="kodePos" class="col-md-12 col-form-label">{{ __('Kode Pos') }}</label>

                                        <div class="col-md-12">
                                            <input id="kodePos" type="text"
                                                class="form-control @error('kode_pos') is-invalid @enderror" name="kode_pos"
                                                value="{{ old('kode_pos') }}" maxlength="5" autocomplete="kode_pos" autofocus>

                                            @error('kode_pos')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="emailperusahaan"
                                            class="col-md-12 col-form-label">{{ __('Email Perusahaan') }}</label>

                                        <div class="col-md-12">
                                            <input id="emailperusahaan" type="email"
                                                class="form-control @error('emailperusahaan') is-invalid @enderror"
                                                name="emailperusahaan" value="{{ old('emailperusahaan') }}"
                                                autocomplete="email" autofocus>

                                            @error('emailperusahaan')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="nomorTelp"
                                            class="col-md-12 col-form-label">{{ __('Nomor Telepon') }}</label>

                                        <div class="col-md-12">
                                            <input id="no_telp" type="text"
                                                class="form-control @error('no_telp') is-invalid @enderror" name="no_telp"
                                                value="{{ old('no_telp') }}" maxlength="13" autocomplete="nomorTelp" autofocus>

                                            @error('no_telp')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="alamat" class="col-md-12 col-form-label">{{ __('Alamat') }}</label>

                                    <div class="col-md-12">
                                        <textarea name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="3">{{ old('alamat') }}</textarea>

                                        @error('alamat')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="tentangPerusahaan"
                                        class="col-md-12 col-form-label">{{ __('Tentang Perusahaan') }}</label>

                                    <div class="col-md-12">
                                        <textarea name="tentang_perusahaan" id="tentang_perusahaan"
                                            class="form-control @error('tentang_perusahaan') is-invalid @enderror" rows="3">{{ old('tentang_perusahaan') }}</textarea>

                                        @error('tentang_perusahaan')
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
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    @endsection
