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
            <div class="card-register">
                <div class="card-header">
                    <h4>Create New Account</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
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

                        <div class="form-group">
                            <div class="row">
                            
                                <div class="col-md-6"> 
                                    <label for="name" class="col-md-12 col-form-label">Nama Depan</label>

                                    <div class="col-md-12">
                                        <input id="name" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}" required autocomplete="firstname" >

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
                                        <input id="name" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" required autocomplete="lastname" >

                                        @error('lastname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                     {{--   <div class="form-group row">
                            <label for="nomor_identitas" class="col-md-4 col-form-label text-md-right">Nomor Identitas</label>

                            <div class="col-md-6">
                                <input id="nomor_identitas" type="text" class="form-control @error('nomor_identitas') is-invalid @enderror" name="nomor_identitas" value="{{ old('nomor_identitas') }}" required autocomplete="nomor_identitas" autofocus>

                                @error('nomor_identitas')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> --}}

                        {{-- <div class="form-group row">
                            <label for="tipe_identitas" class="col-md-4 col-form-label text-md-right">Tipe Identitas</label>

                            <div class="col-md-6">
                                <select class="form-control input-small" name="tipe_identitas" required>
                                    <option value="WNI" selected>Warga Negara Indonesia</option>
                                    <option value="WNA">Warga Negara Asing</option>
                                </select>
                            </div>
                        </div> --}}

                       {{-- <div class="form-group row">
                            <label for="nomer" class="col-md-4 col-form-label text-md-right">Nomor Handphone</label>

                            <div class="col-md-6">
                                <input id="nomer" type="text" class="form-control @error('nomer') is-invalid @enderror" name="nomer" value="{{ old('nomer') }}" required autocomplete="nomer" autofocus>

                                @error('nomer')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>--}}

                     {{--   <div class="form-group row">
                            <label for="kota" class="col-md-4 col-form-label text-md-right">Alamat</label>

                            <div class="col-md-6">
                                <input id="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" value="{{ old('alamat') }}" required autocomplete="alamat" autofocus>

                                @error('alamat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>--}}

                      {{--  <div class="form-group row">
                            <label for="kota" class="col-md-4 col-form-label text-md-right">Kota</label>

                            <div class="col-md-6">
                                <input id="kota" type="text" class="form-control @error('kota') is-invalid @enderror" name="kota" value="{{ old('kota') }}" required autocomplete="kota" autofocus>

                                @error('kota')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>--}}

                        <div class="form-group">
                            <label for="username" class="col-md-12 col-form-label">{{ __('username') }}</label>

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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="password-confirm" class="col-md-12 col-form-label">{{ __('Confirm Password') }}</label>

                            <div class="col-md-12">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                       
                        <input type="hidden" name="peran" value="Peserta">

                        <div class="form-group col-md-6">
                           
                                <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.key') }}"></div>
                                <br/>
                            
                        </div>

                        <div class="form-group mb-0 rata_tengah">
                            <div class="col-md-12 offset-manual">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                                <br>

                                @if (Route::has('login'))
                                    <div class="login">
                                        <span> Already have an account? </span>
                                        <a class="btn btn-link" href="{{ route('login') }}">
                                            {{ __('Login') }}
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
@endsection
