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
    @if(count($errors) > 0)
        @foreach($errors->all() as $error)
            <div class="alert alert-danger">
                <li>{{$error}}</li>
            </div>
        @endforeach
    @endif
    
    @if(Auth::user()->nomor_identitas == null)

    <div class="card-kelengkapan">

        <div class="card-header">
            <p>Kelengkapan Data Diri</p>
        </div>

        <div class="portlet-body form">

            <form role='form' method="POST" action="{{route('peserta.data.pribadi')}}">
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
                        <label for="tanggal_lahir">Tanggal Lahir</label>

                        <input id="txt_tanggal_lahir" type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" name="tanggal_lahir" value="{{ $data['tanggal_lahir'] ?? ''}}" required autocomplete="tanggal_lahir" autofocus>

                        @error('tanggal_lahir')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        
                    </div>

                    <div class="form-group">
                        
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        
                        <div class="col-md-12">
                            <div class="radio-list">
                                <label>
                                    <input id="txt_jenis_kelamin" type="radio" class="form-control @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin" value="Laki-Laki" required autofocus>
                                    Laki-Laki
                                </label>
                                <label>
                                    <input id="txt_jenis_kelamin" type="radio" class="form-control @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin" value="Perempuan" required autofocus> 
                                    Perempuan
                                </label>
                            </div>
                        </div>

                        @error('jenis_kelamin')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        
                    </div>

                    <div class="form-group">
                        <label for="pendidikan_terakhir">Pendidikan Terakhir</label>

                        <div class="col-md-12">
                            <div class="radio-list">
                                <label>
                                    <input id="txt_pendidikan_terakhir" type="radio" class="form-control @error('pendidikan_terakhir') is-invalid @enderror" name="pendidikan_terakhir" value="SD Sederajat" required autofocus>
                                    SD Sederajat
                                </label>
                                <label>
                                    <input id="txt_pendidikan_terakhir" type="radio" class="form-control @error('pendidikan_terakhir') is-invalid @enderror" name="pendidikan_terakhir" value="SMP Sederajat" required autofocus>
                                    SMP Sederajat
                                </label>
                                <label>
                                    <input id="txt_pendidikan_terakhir" type="radio" class="form-control @error('pendidikan_terakhir') is-invalid @enderror" name="pendidikan_terakhir" value="SMA Sederajat" required autofocus> 
                                    SMA Sederajat
                                </label>
                                <label>
                                    <input id="txt_pendidikan_terakhir" type="radio" class="form-control @error('pendidikan_terakhir') is-invalid @enderror" name="pendidikan_terakhir" value="S1" required autofocus> 
                                    S1
                                </label>
                                <label>
                                    <input id="txt_pendidikan_terakhir" type="radio" class="form-control @error('pendidikan_terakhir') is-invalid @enderror" name="pendidikan_terakhir" value="Pasca Sarjana" required autofocus> 
                                    Pasca Sarjana
                                </label>

                            </div>
                        </div>

                        @error('pendidikan_terakhir')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        
                    </div>

                    <div class="form-group">
                        <label for="hobi">Hobi</label>

                        <textarea id="txt_hobi" rows='3' class="form-control @error('hobi') is-invalid @enderror" name="hobi" required autocomplete="hobi" autofocus>
                            {{ $data['hobi'] ?? ''}}
                        </textarea>

                        @error('hobi')
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

    @elseif(Auth::user()->ktp == null)
        <div class="card-kelengkapan">

            <div class="card-header">
                <p>Kelengkapan Dokumen</p>
            </div>

            <div class="portlet-body form">
                
                <p>
                    <span class="label label-danger">NOTE!</span>
                    Upload semua dokumen dalam bentuk .JPG, .PNG atau .PDF
                </p>
                
                <form role='form' method="POST" enctype="multipart/form-data" action="{{ route('peserta.data.dokumen') }}">
                    @csrf
                    <div class="form-body">
                        <div class="form-group">
                            <label for="pas_foto">Pas Foto</label>
                            
                            <input type="file" name='pas_foto' class="defaults" value="{{ $data->pas_foto ?? ''}}" required>
                        </div>

                        <div class="form-group">
                            <label for="ktp">Dokumen KTP</label>
                            
                            <input type="file" name='no_ktp' class="defaults" value="{{ $data->ktp ?? ''}}" required>
                        </div>

                        <div class="form-group">
                            <label for="ksk">Dokumen KSK</label>
                            
                            <input type="file" name='ksk' class="defaults" value="{{ $data->ksk ?? ''}}" required> 
                        </div>

                        <div class="form-group">
                            <label for="ijazah">Dokumen Ijazah</label>
                            
                            <input type="file" name='ijazah' class="defaults" value="{{ $data->ijazah ?? ''}}" required>
                        </div>

                        <div class="form-group form-button">
                            <div class="row">
                                <div class="col-md-6 pull-right">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Submit') }}
                                    </button>
                                </div>

                                <div class="col-md-6 pull-left">
                                    <a class="col-md-8 btn btn-primary" href="{{ route('home') }}">
                                        {{ __('Back') }}
                                    </a>
                                </div>
                            </div>
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
