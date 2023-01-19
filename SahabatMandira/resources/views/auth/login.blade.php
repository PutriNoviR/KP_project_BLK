@extends('layouts.app')


@section('title')
Login
@endsection

@section('javascript')
<script>
    function onSubmit(token) {
         document.getElementById("login-form").submit();
    }    
</script>
<script src="https://www.google.com/recaptcha/api.js?&render=explicit" async defer></script>
<script>
    $(document).ready(function () {
        $("#show_hide_password span ").on('click', function (event) {
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
    });

</script>
@endsection

@section('content')
<main class="py-4" style="height: 100vh; position: fixed; top:0px; right:0px; bottom:0px; left:0px; background-image: linear-gradient(180deg, rgba(0, 0, 255, 0.315), rgba(255, 166, 0, 0.37))">
    <div class="container">
        @if($message = Session::get('error'))
        <div class="alert alert-warning">
            {{$message}}
        </div>
        @endif

        @if($message = Session::get('success'))
        <div class="alert alert-success">
            {{$message}}
        </div>
        @endif

        @if($message = Session::get('recaptcha'))
        <div class="alert alert-danger">
            {{$message}}
        </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="content">
                    <div class="title">
                        <a href="//sahabatmandira.id">
                            <img class="mb-2" src="{{ asset('landingpage/assets/img/logos/sahabatmandira.png') }}" style="height: 60px;" alt="">
                        </a>
                        <p>Selamat Datang Di <b style="color: #0A8AEA">Sahabat</b> <b style="color: #F06128">Mandira</b></p>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h4>{{ __('Masuk ke Akunmu') }}</h4>
                            <p>Masukkan username dan password</p>
                        </div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('login') }}" id="login-form">
                                @csrf

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
                                    <label for="password" class="col-md-12 col-form-label">{{ __('Password') }}</label>

                                    <div class="col-md-12">
                                        <div class="input-group mb-3" id="show_hide_password">
                                            <input id="password" type="password"
                                                class="form-control  @error('password') is-invalid @enderror"
                                                name="password" required autocomplete="current-password"
                                                aria-describedby=" basic-addon2">
                                            <div class="input-group-append">
                                                <span class="input-group-text " style="cursor: pointer" id="basic-addon2"><i
                                                        class="fas fa-eye-slash"></i></span>
                                            </div>
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                                {{ old('remember') ? 'checked' : '' }}>

                                            <label class="form-check-label" for="remember">
                                                {{ __('Ingat Saya') }}
                                            </label>
                                        </div>
                                    </div>
                                </div> -->

                                {{-- <input type="hidden" name="g-recaptcha-response" id="recaptcha_token"> --}}

                                <div class="form-group mb-0 rata_tengah">
                                    <div class="col-md-12 offset-manual">
                                        <button type="submit" class="g-recaptcha btn btn-primary" data-sitekey="{{ config('services.recaptcha.site') }}" data-callback="onSubmit">
                                            {{ __('Masuk') }}
                                        </button>
                                        <br>

                                        @if (Route::has('register'))
                                        <div class="register">
                                            <span> Tidak punya akun? </span>
                                            <a class="btn btn-link" href="{{ route('register') }}">
                                                {{ __('Daftar') }}
                                            </a>
                                        </div>
                                        @endif

                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('Lupa Password ?') }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
