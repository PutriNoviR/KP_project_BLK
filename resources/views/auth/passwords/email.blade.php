@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        {{--    <div class="cover2">
                <img src="{{ asset('assets/image/forgot-password.png')}}">
            </div>--}}

            <div class="card-forgot">
                <div class="card-header">
                    <h4>{{ __('Forgot Your Password') }}</h4>
                    <p>Please enter your email address, so we can send you link to reset your password</p>
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
                            <label for="email" class="col-md-12 col-form-label">{{ __('Email') }}</label>

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
                                    {{ __('Send Password Reset Link') }}
                                </button>
                                <br>

                                @if (Route::has('register'))
                                    <div class="register">
                                        <span> Don't have account? </span>
                                        <a class="btn btn-link" href="{{ route('register') }}">
                                            {{ __('Register') }}
                                        </a>
                                    </div>
                                @endif

                                @if (Route::has('login'))
                                    <a class="btn btn-link" href="{{ route('login') }}">
                                        {{ __('Login') }}
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
@endsection
