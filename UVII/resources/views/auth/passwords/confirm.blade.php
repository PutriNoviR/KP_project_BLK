@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-forgot">
                <div class="card-header">
                    <h4>{{ __('Confirm Token') }}</h4>
                    <p>{{ __('Please confirm your token before continuing.') }}</p>
                </div>

                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.verify_otp') }}">
                        @csrf

                        <div class="form-group">
                            <label for="token" class="col-md-12 col-form-label">{{ __('Token') }}</label>

                            <div class="col-md-12">
                                <input id="token" type="text" class="form-control @error('token') is-invalid @enderror" name="token" placeholder='xxxxxx' required autocomplete="current-password">

                                @error('token')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <input type="hidden" name="email" value="{{ $email?? session('email') }}">
                        </div>

                        <div class="form-group mb-0 rata_tengah">
                            <div class="col-md-12 offset-manual">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Validate') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Send Token Again') }}
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
