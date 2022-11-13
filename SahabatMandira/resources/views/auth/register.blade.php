@extends('layouts.app')


@section('title')
Register
@endsection

@section('javascript')
<script src="https://www.google.com/recaptcha/api.js?render={{config('services.recaptcha.site')}}"></script>
<script>
    setInterval(function () {
        grecaptcha.ready(function () {

            grecaptcha.execute('{{config("services.recaptcha.site")}}', {
                action: 'submit'
            }).then(function (token) {
                // Add your logic to submit to your backend server here.
                if (token) {
                    $("#recaptcha_token").val(token);
                }

            });
        });
    }, 3000);

    $(document).ready(function () {
        $("#show_hide_password span").on('click', function (event) {
            event.preventDefault();
            if ($('#show_hide_password input').attr("type") == "text") {
                $('#show_hide_password input').attr('type', 'password');
                $('#show_hide_password i').addClass("fa-eye-slash");
                $('#show_hide_password i').removeClass("fa-eye");
            } else if ($('#show_hide_password input').attr("type") == "password") {
                $('#show_hide_password input').attr('type', 'text');
                $('#show_hide_password i').removeClass("fa-eye-slash");
                $('#show_hide_password i').addClass("fa-eye");
            }
        });
        $("#show_hide_password_confirmation span").on('click', function (event) {
            event.preventDefault();
            if ($('#show_hide_password_confirmation input').attr("type") == "text") {
                $('#show_hide_password_confirmation input').attr('type', 'password');
                $('#show_hide_password_confirmation i').addClass("fa-eye-slash");
                $('#show_hide_password_confirmation i').removeClass("fa-eye");
            } else if ($('#show_hide_password_confirmation input').attr("type") == "password") {
                $('#show_hide_password_confirmation input').attr('type', 'text');
                $('#show_hide_password_confirmation i').removeClass("fa-eye-slash");
                $('#show_hide_password_confirmation i').addClass("fa-eye");
            }
        });
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
    <div class="col-md-4">
        <div class="card-register" style="width: 100%;">
            <div class="card-header">
                <h4>Benefit Bergabung Menjadi Sahabat</h4>
            </div>

            <div class="card-body">

            </div>
        </div>
    </div>
    
    <div class="col-md-8">
        <div class="card-register" style="width: 100%;">
            <div class="card-header">
                <h4>Formulir Pendaftaran Akun Baru</h4>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

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
                        <div class="row">

                            <div class="col-md-6">
                                <label for="name" class="col-md-12 col-form-label">Nama Depan</label>

                                <div class="col-md-12">
                                    <input id="name" type="text"
                                        class="form-control @error('firstname') is-invalid @enderror" name="firstname"
                                        value="{{ old('firstname') }}" required autocomplete="firstname">

                                    @error('firstname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="name" class="col-md-12 col-form-label">Nama Belakang</label>

                                <div class="col-md-12">
                                    <input id="name" type="text"
                                        class="form-control @error('lastname') is-invalid @enderror" name="lastname"
                                        value="{{ old('lastname') }}" required autocomplete="lastname">

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
                                value="{{ old('username') }}" required autocomplete="username" autofocus>

                            @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nomer_hp" class="col-md-12 col-form-label">{{ __('Nomor Telepon') }}</label>
                        <div class="col-md-12">
                            <input id="nomer_hp" type="text"
                                class="form-control @error('nomer_hp') is-invalid @enderror" name="nomer_hp" required
                                autocomplete="nomer_hp">

                            @error('nomer_hp')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="role" class="col-md-12 col-form-label">{{ __('Sebagai') }}</label>

                        <div class="col-md-12">
                            <select name="role" id="role" class="form-control">
                                <option value="peserta">Peserta</option>
                                <option value="verifikator">Instruktur</option>
                                <option value="adminperusahaan">Mitra</option>
                                <option value="mentor">Mentor</option>
                            </select>

                            @error('role')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password" class="col-md-12 col-form-label">{{ __('Password') }}</label>

                        <div class="col-md-12">
                            <div class="input-group mb-3" id="show_hide_password">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required aria-describedby="basic-addon-password">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon-password" style="cursor: pointer"><i
                                            class="fas fa-eye-slash"></i></span>
                                </div>

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>'Password anda harus terdiri dari minimal 8 karakter, harus mengandung
                                        setidaknya 1 Huruf Besar, 1 Huruf Kecil, 1 Numerik dan 1 karakter
                                        khusus(#,?,!,@,$,%,^,&,*,-).'</strong>
                                </span>
                                @enderror
                            </div>

                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password-confirm"
                            class="col-md-12 col-form-label">{{ __('Konfirmasi Password') }}</label>

                        <div class="col-md-12">
                            <div class="input-group mb-3" id="show_hide_password_confirmation">
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required
                                    aria-describedby="basic-addon-confirmation-password">
                                <div class="input-group-append">
                                    <span class="input-group-text " style="cursor: pointer"
                                        id="basic-addon-confirmation-password"><i class="fas fa-eye-slash"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- <input type="hidden" name="g-recaptcha-response" id="recaptcha_token"> -->

                    {{-- <div class="form-group col-md-6">
                        <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.key') }}">
                        </div>
                        <br />
                    </div> --}}

                    <div class="form-group mb-0 text-center">
                        <div class="col-md-12 offset-manual">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Register') }}
                            </button>
                            <br>

                            @if (Route::has('login'))
                            <div class="text-center mt-3">
                                <span>Sudah punya akun? </span>
                                <a class="btn btn-link d-inline" href="{{ route('login') }}">
                                    {{ __('Masuk') }}
                                </a>
                            </div>
                            @endif

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
