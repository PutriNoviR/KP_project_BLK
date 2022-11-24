@extends('layouts.app')

@section('content')
<div class="container">
    @if(count($errors) > 0)
        @foreach($errors->all() as $error)
        <div class="alert alert-danger">
            <li>{{$error}}</li>
        </div>
        @endforeach
    @endif

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-forgot">
                <div class="card-header">
                    <h4>{{ __('Confirm Token') }}</h4>
                    <p>{{ __('Please confirm your token before continuing.') }}</p>
                </div>

                <div class="card-body">

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

                            <input type="hidden" name="email" value="{{ $email?? old('email') }}">
                        </div>

                        <div class="form-group mb-0 rata_tengah">
                            <div class="col-md-12 offset-manual">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Validate') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Back') }}
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
