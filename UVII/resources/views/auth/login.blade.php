@extends('layouts.app')

@section('javascript')
    <script>
        function showPassword(idbtn, idpass)
        {
            var tipe = $(idpass).attr('type');
            $(idbtn).removeClass();

            if(tipe == 'password'){
                $(idpass).attr('type', 'text');
            
                $(idbtn).addClass('fa fa-eye-slash toggleBtn');
            }
            else{
                $(idpass).attr('type', 'password');
        
                $(idbtn).addClass('fa fa-eye toggleBtn');
            }
     
        }
    </script>
@endsection

@section('content')
<div class="container">
    @if($message = Session::get('success'))
        <div class="alert alert-success">
            {{$message}}
        </div>
    @endif

    @if(count($errors) > 0)
        @foreach($errors->all() as $error)
        <div class="alert alert-danger">
            <li>{{$error}}</li>
        </div>
        @endforeach
    @endif

    <div class="row justify-content-center">
     
        <div class="col-md-8">
            <div class="content">
                <div class="title">
                    <p>Selamat Datang pada</p>
                    <p>UBAYA VOCATIONAL INTEREST INVENTORY</p>
                </div>
            
                <div class="card">
                    <div class="card-header">
                        <h4>{{ __('Login to Your Account') }}</h4>
                        <p>Please enter your username and password</p>
                    </div>

                    <div class="card-body">
                        <form id='register-form' method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group">
                                <label for="username" class="col-md-12 col-form-label">{{ __('Username') }}</label>

                                <div class="col-md-12">
                                    <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

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
                                    <i class="fa fa-eye toggleBtn" onclick='showPassword(this, "#password")'></i>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-0 rata_tengah">
                                <div class="col-md-12 offset-manual">
                                    <button type="button" class="btn btn-primary g-recaptcha" data-sitekey="{{config('services.recaptcha.site')}}" 
                                                data-callback='onSubmit'>
                                        {{ __('Login') }}
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

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Password') }}
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
@endsection
