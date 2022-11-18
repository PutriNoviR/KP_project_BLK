@extends('layouts.app')


@section('title')
Register
@endsection

@section('javascript')
<script src="https://www.google.com/recaptcha/api.js?render={{config('services.recaptcha.site')}}"></script>
<script>
    setInterval(function () {
        grecaptcha.ready(function () {

            grecaptcha.execute('{{config("services.recaptcha.site")}}', {
                action: 'submit'
            }).then(function (token) {
                // Add your logic to submit to your backend server here.
                if (token) {
                    $("#recaptcha_token").val(token);
                }

            });
        });
    }, 3000);

    $(document).ready(function () {
        $("#show_hide_password span").on('click', function (event) {
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
        $("#show_hide_password_confirmation span").on('click', function (event) {
            event.preventDefault();
            if ($('#show_hide_password_confirmation input').attr("type") == "text") {
                $('#show_hide_password_confirmation input').attr('type', 'password');
                $('#show_hide_password_confirmation i').addClass("fa-eye-slash");
                $('#show_hide_password_confirmation i').removeClass("fa-eye");
            } else if ($('#show_hide_password_confirmation input').attr("type") == "password") {
                $('#show_hide_password_confirmation input').attr('type', 'text');
                $('#show_hide_password_confirmation i').removeClass("fa-eye-slash");
                $('#show_hide_password_confirmation i').addClass("fa-eye");
            }
        });
    });

</script>
@endsection

@section('content')
<main class="py-4" style="position: relaative; top:0px; right:0px; bottom:0px; left:0px; background-image: linear-gradient(180deg, rgba(0, 0, 255, 0.315), rgba(255, 166, 0, 0.37))">
    <div class="container">
        {{-- @if(count($errors) > 0)
        @foreach($errors->all() as $error)
        <div class="alert alert-danger">
            <li>{{$error}}</li>
    </div>
    @endforeach
    @endif --}}

    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card mt-4" style="width: 100%;">
                <div class="card-header">
                    <h4>Benefit Bergabung Menjadi Sahabat</h4>
                </div>

                <div class="card-body">
                    <div class="card text-white bg-primary mb-3">
                        <div class="card-header">Sebagai Pencari Kerja</div>
                        <div class="card-body">
                            <ol style="text-align: justify;">
                                <li><p class="card-text">Mendapatkan informasi seputar pelatihan yang difasilitasi oleh BLK, Mitra, dan UBAYA.</p></li>
                                <li><p class="card-text">Mendapatkan informasi seputar lowongan pekerjaan yang disediakan oleh mitra perusahaan.</p></li>
                                <li><p class="card-text">Akses terhadap berbagai pelatihan bersertifikat.</p></li>
                            </ol>
                        </div>
                    </div>

                    <div class="card text-white bg-success mb-3">
                        <div class="card-header">Sebagai Mentor</div>
                        <div class="card-body">
                            <ol style="text-align: justify;">
                                <li><p class="card-text">Akses fasilitas untuk penawaran pelatihan</p></li>
                            </ol>
                        </div>
                    </div>

                    <div class="card text-white bg-info mb-3">
                        <div class="card-header">Sebagai Perusahaan</div>
                        <div class="card-body">
                            <ol style="text-align: justify;">
                                <li><p class="card-text">Akses fasilitas untuk membuka lowongan pekerjaan sesuai dengan kebutuhan perusahaan.</p></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-8">
            <div class="card mt-4" style="width: 100%;">
                <div class="card-header">
                    <h4>Formulir Pendaftaran Akun Baru</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group">
                            <label for="email" class="col-md-12 col-form-label">{{ __('Email') }} <img class="ml-1 mb-2" style="width: 15px;" data-toggle="tooltip" data-placement="top" title="Email aktif yang anda gunakan sehari-hari." src="{{ asset('quest-mark.png') }}"></label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

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
                                    <label for="name" class="col-md-12 col-form-label">Nama Depan <img class="ml-1 mb-2" style="width: 15px;" data-toggle="tooltip" data-placement="top" title="Nama depan anda." src="{{ asset('quest-mark.png') }}"></label>

                                    <div class="col-md-12">
                                        <input id="name" type="text"
                                            class="form-control @error('firstname') is-invalid @enderror" name="firstname"
                                            value="{{ old('firstname') }}" required autocomplete="firstname">

                                        @error('firstname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="name" class="col-md-12 col-form-label">Nama Belakang <img class="ml-1 mb-2" style="width: 15px;" data-toggle="tooltip" data-placement="top" title="Nama belakang anda." src="{{ asset('quest-mark.png') }}"></label>

                                    <div class="col-md-12">
                                        <input id="name" type="text"
                                            class="form-control @error('lastname') is-invalid @enderror" name="lastname"
                                            value="{{ old('lastname') }}" required autocomplete="lastname">

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
                            <label for="username" class="col-md-12 col-form-label">{{ __('Username') }} <img class="ml-1 mb-2" style="width: 15px;" data-toggle="tooltip" data-placement="top" title="Nama pengguna yang akan digunakan untuk akses Sahabat Mandira." src="{{ asset('quest-mark.png') }}"></label>

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
                            <label for="nomer_hp" class="col-md-12 col-form-label">{{ __('Nomor Telepon') }} <img class="ml-1 mb-2" style="width: 15px;" data-toggle="tooltip" data-placement="top" title="Nomor telepon aktif yang dapat dihubungi dan terdaftar di aplikasi WhatsApp." src="{{ asset('quest-mark.png') }}"></label>
                            <div class="col-md-12">
                                <input id="nomer_hp" type="text"
                                    class="form-control @error('nomer_hp') is-invalid @enderror" name="nomer_hp" required
                                    autocomplete="nomer_hp">

                                @error('nomer_hp')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="role" class="col-md-12 col-form-label">{{ __('Sebagai') }} <img class="ml-1 mb-2" style="width: 15px;" data-toggle="tooltip" data-placement="top" title="Status anda sebagai pengguna fasilitas Sahabat Mandira." src="{{ asset('quest-mark.png') }}"></label>

                            <div class="col-md-12">
                                <select name="role" id="role" class="form-control">
                                    <option value="peserta">Peserta</option>
                                    <option value="verifikator">Instruktur</option>
                                    <option value="adminperusahaan">Mitra</option>
                                    <option value="mentor">Mentor</option>
                                </select>

                                @error('role')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-12 col-form-label">{{ __('Password') }} <img class="ml-1 mb-2" style="width: 15px;" data-toggle="tooltip" data-placement="top" title="Password yang akan digunakan untuk akses Sahabat Mandira. Minimal 8 karakter. Pastikan password anda terdiri dari gabungan huruf kapital, huruf kecil, numerik(angka), serta simbol." src="{{ asset('quest-mark.png') }}"></label>

                            <div class="col-md-12">
                                <div class="input-group mb-3" id="show_hide_password">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required aria-describedby="basic-addon-password">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon-password" style="cursor: pointer"><i
                                                class="fas fa-eye-slash"></i></span>
                                    </div>

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>'Password anda harus terdiri dari minimal 8 karakter, harus mengandung
                                            setidaknya 1 Huruf Besar, 1 Huruf Kecil, 1 Numerik dan 1 karakter
                                            khusus(#,?,!,@,$,%,^,&,*,-).'</strong>
                                    </span>
                                    @enderror
                                </div>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm"
                                class="col-md-12 col-form-label">{{ __('Konfirmasi Password') }} <img class="ml-1 mb-2" style="width: 15px;" data-toggle="tooltip" data-placement="top" title="Masukkan kembali password  yang telah anda tentukan sebelumnya." src="{{ asset('quest-mark.png') }}"></label>

                            <div class="col-md-12">
                                <div class="input-group mb-3" id="show_hide_password_confirmation">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required
                                        aria-describedby="basic-addon-confirmation-password">
                                    <div class="input-group-append">
                                        <span class="input-group-text " style="cursor: pointer"
                                            id="basic-addon-confirmation-password"><i class="fas fa-eye-slash"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- <input type="hidden" name="g-recaptcha-response" id="recaptcha_token"> -->

                        {{-- <div class="form-group col-md-6">
                            <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.key') }}">
                            </div>
                            <br />
                        </div> --}}

                        <div class="form-group mb-0 text-center">
                            <div class="col-md-12 offset-manual">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                                <br>

                                @if (Route::has('login'))
                                <div class="text-center mt-3">
                                    <span>Sudah punya akun? </span>
                                    <a class="btn btn-link d-inline" href="{{ route('login') }}">
                                        {{ __('Masuk') }}
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
