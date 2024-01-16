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

        function textCounterValidation(id){
            var no_hp = $(id).val();
            var digit = 'digit';

            if(no_hp.length > 1){
                digit = 'digits';
            }

            $("#counter").html(no_hp.length + ' ' + digit);

            if(no_hp.length >= 9 && no_hp.length < 14){
               
                $('#counter').css('color','green');
            }
            else{
                $('#counter').css('color','red');
            }
        }

        function passwordMinimumValidation(id){
            var pass = $(id).val().trim();
            var number = /([0-9])/;
            var alphabets = /([A-Z])/;
            var special_characters = /([~,!,@,#,$,%,^,&,*,-,_,+,=,?,>,<])/;
   
            if(pass.length >= 8){
                $('#passKarakter').css('color','green');

                if(pass.match(number)){
                    $('#passAngka').css('color','green');
                }

                if(pass.match(alphabets)){    
                    $('#passKapital').css('color','green');

                }
                
                if(pass.match(special_characters)) {
                    $('#passSimbol').css('color','green');
                } 
            }

            else{
                $('#passKarakter').css('color','red');

                $('#passAngka').css('color','red');
                
                $('#passSimbol').css('color','red');

                $('#passKapital').css('color','red');
            }
          
        }

        
    </script>
@endsection

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
                    <form method="POST" id='register-form' action="{{ route('register') }}">
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
                                        <input id="name" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" required autocomplete="lastname">

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
                            <label for="nomer" class="col-md-12 col-form-label">Nomor Handphone</label>

                            <div class="col-md-12">
                                <input id="nomer" type="text" class="form-control @error('nomer') is-invalid @enderror" name="nomer" value="{{ old('nomer') }}" required autocomplete="nomer" autofocus onKeyUp='textCounterValidation(this)'>
                                <span id='counter' style='color: red; float: right;'></span>

                                @error('nomer')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

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
                                
                                <i class="fa fa-eye toggleBtn" onclick='showPassword(this, "#password")'></i>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" onKeyUp='passwordMinimumValidation(this)'>
                                <span class="password-minimum">Minimum Password :</span>
                                <span id='passKarakter' class="password-minimum">8 Karakter</span>
                                <span id='passAngka' class="password-minimum">1 Angka</span>
                                <span id='passKapital' class="password-minimum">1 Huruf Kapital</span>
                                <span id='passSimbol' class="password-minimum">1 Simbol</span><br>

                                @error('password')
                                    <br><span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="password-confirm" class="col-md-12 col-form-label">{{ __('Confirm Password') }}</label>

                            <div class="col-md-12">
                                <i class="fa fa-eye toggleBtn" onclick='showPassword(this, "#password-confirm")'></i>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                       
                        <input type="hidden" name="peran" value="peserta">
<!-- Recaptcha v2
                        <div class="form-group col-md-6">
                           
                                <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.key') }}"></div>
                                <br/>
                            
                        </div> -->

                        <div class="form-group mb-0 rata_tengah">
                            <div class="col-md-12 offset-manual">
                                <button type="button" class="btn btn-primary g-recaptcha" data-sitekey="{{config('services.recaptcha.site')}}" 
                                                data-callback='onSubmit'>
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

                            {{--    @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.baru') }}">
                                        {{ __('Forgot Password') }}
                                    </a>
                                @endif --}}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
