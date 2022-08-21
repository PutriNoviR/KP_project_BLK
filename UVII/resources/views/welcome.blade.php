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
    @section('javascript')
    <script>
        function show(){
            $('#modalTes').css('display', 'block');   
            $('#page').css('filter', 'blur(4px)');
        }

        function unshow(){
            $('#modalTes').css('display', 'none');   
            $('#page').css('filter', 'blur(0)');
        }
        
    </script>
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
                            
                                <option value="WNI" selected>Indonesia</option>
                                <option value="WNA">Bukan Indonesia</option>

                        </select>
                        
                    </div>

                    <div class="form-group">
                        <label for="jenis_identitas">Jenis Identitas</label>

                        <select id="txt_jenis_identitas" class="form-control" name="jenis_identitas" required>
                    
                                <option value="KTP" selected>KTP</option>
                                <option value="Pasport">Pasport</option>
                            
                        </select>
                        
                    </div>

                    <div class="form-group">
                        <label for="nomor_identitas">Nomor Identitas</label>

                        <input id="txt_nomor_identitas" type="text" class="form-control @error('nomor_identitas') is-invalid @enderror" name="nomor_identitas" required autocomplete="nomor_identitas" autofocus>

                        @error('nomor_identitas')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    
                    </div>

                    <div class="form-group">
                        <label for="tanggal_lahir">Tanggal Lahir</label>

                        <input id="txt_tanggal_lahir" type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" name="tanggal_lahir" required autocomplete="tanggal_lahir" autofocus>

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
                           
                        </textarea>

                        @error('hobi')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    
                    </div>

                    <div class="form-group">
                        <label for="kota">Alamat</label>

                        <input id="txt_alamat" type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" required autocomplete="alamat" autofocus>

                        @error('alamat')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    
                    </div>

                    <div class="form-group">
                        <label for="kota">Kota</label>

                        <input id="txt_kota" type="text" class="form-control @error('kota') is-invalid @enderror" name="kota" required autocomplete="kota" autofocus>

                        @error('kota')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    
                    </div>

                    <div class="form-group form-button">
                
                        <button type="submit" class="btn btn-primary">
                            {{ __('Save') }}
                        </button>
                    
                    </div>
                    
                </div>
            
            </form>
        </div>

    </div>

    {{-- @elseif(Auth::user()->ktp == null)
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

        </div> --}}

    @else
    <div class="card-page">
            <div id="page">
                <div class="card-header">
                    <p>Tes Minat Bakat</p>
                </div>

                <div class="card-body">
                    <div class="body-title" >
                        <p>Hal Penting tentang Tes Minat Bakat:</p>
                    </div>
                    <div class="body-content">
                        <ul class="tulisan_rata">
                            <li>    
                                Tes minat bakat akan menentukan kejuruan dari pelatihan yang nantinya kalian ambil.
                            </li>
                            <li>
                                Ketika mengikuti tes ini, kalian harus menyelesaikan beberapa soal dalam bentuk 
                                    pilihan ganda dan harus diselesaikan dalam waktu yang telah disediakan.  
                                    Selama pengerjaan kalian dapat kembali ke soal sebelumnya.
                            </li>
                            <li>
                                Silahkan menekan tombol <b>Mulai Tes</b> jika merasa sudah siap.
                            </li>
                        </ul>
                    </div>

                    <div class="body-btn">
                        @if($tes == null)
                            <button type="button" class="btn btn-primary" onclick="show()">
                                Mulai Tes
                            </button>
                        @else
                            <a href="{{ route('peserta.uji.tahap.awal') }}" class="button btn btn-primary">Lanjut Tes</a>
                        @endif

                    </div>
                </div>

            </div>

            <div id="modalTes">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body" style="text-align: center;">
                            <div class="modal-body-icon">
                                <i class="glyphicon glyphicon-warning-sign"></i>
                            </div>
                            <p>
                                Waktu akan berjalan setelah kalian menekan tombol <b>Mulai</b>.
                            </p>
                            <p>
                                Pastikan menyelesaikan soal tepat waktu.
                            </p>
                        </div>
    
                        <div class="modal-btn">
                            <a href="{{ route('peserta.uji.tahap.awal') }}" class="button btn btn-primary">Mulai</a>
                            <button type="button" class="btn btn-default" onclick="unshow()">Kembali</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

          
@endsection
    {{--</body>
</html>--}}
