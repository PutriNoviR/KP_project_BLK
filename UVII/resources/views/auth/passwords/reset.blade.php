@extends('layouts.app')

@section('javascript')
    <script>
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
    @if($message = Session::get('error'))
    <div class="alert alert-danger">
        <li>{{$message}}</li>
    </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card-forgot">
                <div class="card-header">
                    <h4>{{ __('Reset Password') }}</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.updates') }}">
                        @csrf

                      {{-- <input type="hidden" name="token" value="{{ $token }}"> --}}

                       
                        <input id="email" type="hidden" name="email" value="{{ $email?? old('email') }}">

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <i class="fa fa-eye toggleBtn" onclick='showPassword(this, "#password")'></i>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" onKeyUp='passwordMinimumValidation(this)'><br>
                                
                                <span class="password-minimum">Minimum Password :</span>
                                <span id='passKarakter' class="password-minimum">8 Karakter</span>
                                <span id='passAngka' class="password-minimum">1 Angka</span>
                                <span id='passKapital' class="password-minimum">1 Huruf Kapital</span>
                                <span id='passSimbol' class="password-minimum">1 Simbol</span><br><br><br>
                               
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <i class="fa fa-eye toggleBtn" onclick='showPassword(this, "#password-confirm")'></i>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
