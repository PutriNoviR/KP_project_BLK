@extends('layouts.app')

@section('content')
<main class="py-4" style="position: absolute; top:0px; right:0px; bottom:0px; left:0px; background-image: linear-gradient(180deg, rgba(0, 0, 255, 0.315), rgba(255, 166, 0, 0.37))">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        {{--    <div class="cover2">
                <img src="{{ asset('assets/image/forgot-password.png')}}">
            </div>--}}

            <div class="card-forgot">
                <div class="card-header">
                    <h4>{{ __('Permintaan Reset Password') }}</h4>
                    <p>Harap masukkan alamat email yang terdaftar, sehingga kami dapat mengirimkan link untuk reset password anda.</p>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group">
                            <label for="email" class="col-md-12 col-form-label">{{ __('Email') }} <img class="ml-1 mb-2" style="width: 15px;" data-toggle="tooltip" data-placement="top" title="Email yang anda gunakan saat mendaftar." src="{{ asset('quest-mark.png') }}"></label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-0 rata_tengah">
                            <div class="col-md-12 offset-manual">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Kirim Link Reset Password') }}
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

                                @if (Route::has('login'))
                                    <div class="register">
                                        <span> Sudah punya akun? </span>
                                        <a class="btn btn-link" href="{{ route('login') }}">
                                            {{ __('Login') }}
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
</main>
@endsection
