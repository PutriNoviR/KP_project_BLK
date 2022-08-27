@extends('layouts.app')

@section('javascript')
<script>
    $(function () {
        $('#perusahaan').hide();

        $('#tombolnext').click(function () {
            $('#user').hide();
            $('#perusahaan').show();
        });
    });

    $('#logo').on('change', function () {
        //get the file name
        var fileName = $(this).val().replace('C:\\fakepath\\', " ");
        //replace the "Choose a file" label
        $(this).next('.custom-file-label').html(fileName);
    });
    $('#foto_perusahaan').on('change', function () {
        //get the file name
        var fileName = $(this).val().replace('C:\\fakepath\\', " ");
        //replace the "Choose a file" label
        $(this).next('.custom-file-label').html(fileName);
    });
    $('#npwp').on('change', function () {
        //get the file name
        var fileName = $(this).val().replace('C:\\fakepath\\', " ");
        //replace the "Choose a file" label
        $(this).next('.custom-file-label').html(fileName);
    });
    $('#siup').on('change', function () {
        //get the file name
        var fileName = $(this).val().replace('C:\\fakepath\\', " ");
        //replace the "Choose a file" label
        $(this).next('.custom-file-label').html(fileName);
    });

</script>
@endsection

@section('content')
<div class="container">
    {{-- @if(count($errors) > 0)
    @foreach($errors->all() as $error)
    <div class="alert alert-danger">
        <li>{{$error}}</li>
</div>
@endforeach
@endif --}}

<div class="row justify-content-center">

    <div class="col-md-8">
        <div class="card-register">
            <div class="card-header">
                <h4>Daftar Perusahaan</h4>
            </div>

            <div class="card-body">
                <form method="POST" enctype="multipart/form-data" action="{{ route('perusahaan.store') }}">
                    @csrf
                    <div id="user">

                        <div class="form-group">
                            <label for="email" class="col-md-12 col-form-label">{{ __('Email') }}</label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">

                                <div class="col-md-6">
                                    <label for="firstname" class="col-md-12 col-form-label">Nama Depan</label>

                                    <div class="col-md-12">
                                        <input id="firstname" type="text"
                                            class="form-control @error('firstname') is-invalid @enderror"
                                            name="firstname" value="{{ old('firstname') }}" autocomplete="firstname">

                                        @error('firstname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="lastname" class="col-md-12 col-form-label">Nama Belakang</label>

                                    <div class="col-md-12">
                                        <input id="lastname" type="text"
                                            class="form-control @error('lastname') is-invalid @enderror" name="lastname"
                                            value="{{ old('lastname') }}" autocomplete="lastname">

                                        @error('lastname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="username" class="col-md-12 col-form-label">{{ __('Username') }}</label>
                            <div class="col-md-12">
                                <input id="username" type="text"
                                    class="form-control @error('username') is-invalid @enderror" name="username"
                                    value="{{ old('username') }}" autocomplete="username" autofocus>

                                @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-12 col-form-label">{{ __('Password') }}</label>

                            <div class="col-md-12">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm"
                                class="col-md-12 col-form-label">{{ __('Confirm Password') }}</label>

                            <div class="col-md-12">
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" autocomplete="new-password">
                            </div>
                        </div>

                        <input type="hidden" name="peran" value="adminperusahaan">
                        <div class="form-group">
                            <div class="col-md-12 offset-manual">
                                <button type="button" id="tombolnext" class="btn btn-primary">
                                    {{ __('Selanjutnya') }}
                                </button>
                            </div>
                        </div>
                    </div>
                    <div id="perusahaan">
                        <div class="form-group">
                            <label for="nama" class="col-md-12 col-form-label">{{ __('Nama Perusahaan') }}</label>

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

                        <div class="form-group">
                            <label for="alamat" class="col-md-12 col-form-label">{{ __('Alamat') }}</label>

                            <div class="col-md-12">
                                <input id="alamat" type="text"
                                    class="form-control @error('alamat') is-invalid @enderror" name="alamat"
                                    value="{{ old('alamat') }}" autocomplete="alamat" autofocus>

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
                                <input id="kodePos" type="text"
                                    class="form-control @error('kode_pos') is-invalid @enderror" name="kode_pos"
                                    value="{{ old('kode_pos') }}" autocomplete="kode_pos" autofocus>

                                @error('kode_pos')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nomorTelp" class="col-md-12 col-form-label">{{ __('Nomor Telepon') }}</label>

                            <div class="col-md-12">
                                <input id="no_telp" type="text"
                                    class="form-control @error('no_telp') is-invalid @enderror" name="no_telp"
                                    value="{{ old('no_telp') }}" autocomplete="nomorTelp" autofocus>

                                @error('no_telp')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="emailperusahaan"
                                class="col-md-12 col-form-label">{{ __('Email Perusahaan') }}</label>

                            <div class="col-md-12">
                                <input id="emailperusahaan" type="email"
                                    class="form-control @error('emailperusahaan') is-invalid @enderror"
                                    name="emailperusahaan" value="{{ old('emailperusahaan') }}" autocomplete="email"
                                    autofocus>

                                @error('emailperusahaan')
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
                                <textarea name="tentang_perusahaan"
                                    class="form-control @error('tentang_perusahaan') is-invalid @enderror"
                                    rows="3">{{ old('tentang_perusahaan') }}</textarea>

                                @error('tentang_perusahaan')
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

                        </div>

                        <div class="form-group">
                            <label class="col-md-12" for="foto">Logo Perusahaan</label>
                            <div class="custom-file ">
                                <input type="file" name="logo" class="custom-file-input @error('logo') 
                                is-invalid @enderror" id="logo">
                                <label class="custom-file-label mx-2" for="logo">Choose file...</label>
                                @error('logo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12" for="foto">Foto Perusahaan</label>
                            <div class="custom-file px-2">
                                <input type="file" name="foto_perusahaan" class="custom-file-input @error('foto_perusahaan') 
                                    is-invalid @enderror" id="foto_perusahaan">
                                <label class="custom-file-label mx-2" for="foto_perusahaan">Choose file...</label>
                                @error('foto_perusahaan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12" for="siup">SIUP</label>

                            <div class="custom-file px-2">
                                <input type="file" name="siup" class="custom-file-input @error('siup') 
                                    is-invalid @enderror" id="siup">
                                <label class="custom-file-label mx-2" for="siup">Choose file...</label>
                                @error('siup')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12" for="npwp">NPWP</label>

                            <div class="custom-file px-2">
                                <input type="file" name="npwp" class="custom-file-input @error('npwp') 
                                    is-invalid @enderror" id="npwp">
                                <label class="custom-file-label mx-2" for="npwp">Choose file...</label>
                                @error('npwp')
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
