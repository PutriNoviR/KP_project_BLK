@extends('layouts.app')


@section('title')
Login
@endsection

@section('javascript')
<script src="https://www.google.com/recaptcha/api.js?render={{config('services.recaptcha.site')}}"></script>
<script>
   setInterval(function () {
        grecaptcha.ready(function() {
            
            grecaptcha.execute('{{config("services.recaptcha.site")}}', {action: 'submit'}).then(function(token) {
                // Add your logic to submit to your backend server here.
                if(token){
                    $("#recaptcha_token").val(token);
                }
               
            });
        });
    }, 3000);

</script>
@endsection

@section('content')
<div class="container">
    @if($message = Session::get('success'))
    <div class="alert alert-success">
        {{$message}}
    </div>
    @endif

    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="content">
                <div class="title">
                    <p>Selamat Datang Di Sahabat Mandira</p>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h4>{{ __('Masuk ke Akunmu') }}</h4>
                        <p>Masukkan username dan password</p>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
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
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
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

                            <input type="hidden" name="g-recaptcha-response" id="recaptcha_token">

                            <div class="form-group mb-0 rata_tengah">
                                <div class="col-md-12 offset-manual">
                                    <button type="submit" class="btn btn-primary">
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

                                                                    </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
