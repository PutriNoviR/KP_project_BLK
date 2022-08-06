{{-- 
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    <link rel="shortcut icon" href="favicon.ico">

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            .content {
                text-align: center;
            }

            .titles {
                font-size: 84px;
            }


            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body> --}}
    
    @extends('layouts.index')

    @section('title')
            Dashboard
    @endsection

    @section('page-bar')
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="http://127.0.0.1:8000/">Dashboard</a>
                <i class="fa fa-angle-right"></i>
            </li>
        </ul>
    @endsection

    @section('contents')
    
    @if(Auth::user()->nomor_identitas == null)

    <div class="card-kelengkapan">

        <div class="card-header">
            <p>Kelengkapan Data Diri</p>
        </div>

        <div class="portlet-body form">

            <form role='form' method="POST" action="{{route('pengguna.data.pribadi')}}">
                @csrf
                <div class="form-body">
                    <div class="form-group">
                        <label for="kewarganegaraan">Kewarganegaraan</label>

                        <select id='txt_kewarganegaraan' class="form-control" name="kewarganegaraan" required>
                            @if(session()->get('kelengkapanData') != null)
                                <option value="WNI" {{$data['jenis_identitas'] == 'KTP' ? "selected":"" }}>Indonesia</option>
                                <option value="WNA" {{$data['jenis_identitas'] != 'KTP' ? "selected":"" }}>Bukan Indonesia</option>
                            
                            @else
                                <option value="WNI" selected>Indonesia</option>
                                <option value="WNA">Bukan Indonesia</option>
                            @endif

                        </select>
                        
                    </div>

                    <div class="form-group">
                        <label for="jenis_identitas">Jenis Identitas</label>

                        <select id="txt_jenis_identitas" class="form-control" name="jenis_identitas" required>
                            @if(session()->get('kelengkapanData') != null)
                                <option value="KTP" {{$data['jenis_identitas'] == 'KTP' ? "selected":"" }}>KTP</option>
                                <option value="Pasport" {{$data['jenis_identitas'] != 'KTP' ? "selected":"" }}>Pasport</option>
                            @else
                                <option value="KTP" selected>KTP</option>
                                <option value="Pasport">Pasport</option>
                            @endif
                        </select>
                        
                    </div>

                    <div class="form-group">
                        <label for="nomor_identitas">Nomor Identitas</label>

                        <input id="txt_nomor_identitas" type="text" class="form-control @error('nomor_identitas') is-invalid @enderror" name="nomor_identitas" value="{{ $data['nomor_identitas'] ?? ''}}" required autocomplete="nomor_identitas" autofocus>

                        @error('nomor_identitas')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    
                    </div>

                    <div class="form-group">
                        <label for="nomer">Nomor Handphone</label>

                        <input id="txt_nomer" type="text" class="form-control @error('nomer') is-invalid @enderror" name="nomer" value="{{ $data['nomer_hp'] ?? ''}}" required autocomplete="nomer" autofocus>

                        @error('nomer')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        
                    </div>

                    <div class="form-group">
                        <label for="kota">Alamat</label>

                        <input id="txt_alamat" type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" value="{{ $data['alamat'] ?? ''}}" required autocomplete="alamat" autofocus>

                        @error('alamat')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    
                    </div>

                    <div class="form-group">
                        <label for="kota">Kota</label>

                        <input id="txt_kota" type="text" class="form-control @error('kota') is-invalid @enderror" name="kota" value="{{ $data['kota'] ?? ''}}" required autocomplete="kota" autofocus>

                        @error('kota')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    
                    </div>

                    <div class="form-group form-button">
                
                        <button type="submit" class="btn btn-primary">
                            {{ __('Next') }}
                        </button>
                    
                    </div>
                    
                </div>
            
            </form>
        </div>

    </div>

    @else
        <div class="card-kelengkapan">
            <div class="card-header">
                <h4>Selamat datang, peserta {{Auth::user()->nama_depan.' '.Auth::user()->nama_belakang}}</h4>
            </div><br>
        </div>
    @endif
          
    @endsection
    {{--</body>
</html>--}}
