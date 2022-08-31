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
    
    @extends('layouts.index',['menu' => $menu_role])

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

        function getEditForm(id){
            $.ajax({
            type:'POST',
            url:'{{ route("soal.edit")}}',
            data:{'_token':'<?php echo csrf_token() ?>',
                    'id':id
                },
            success: function(data){
                // alert(data.msg);
                $('#modalContent').html(data.msg)
            }
            });
        }

    </script>
    @endsection

    @section('page-bar')
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="{{route('home')}}">Dashboard</a>
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
    
    @if(Auth::user()->role->nama_role == 'Peserta')
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
                                        <input id="txt_pendidikan_terakhir" type="radio" class="form-control @error('pendidikan_terakhir') is-invalid @enderror" name="pendidikan_terakhir" value="D3/D4" required autofocus> 
                                        D3/D4 (Diploma)
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

                            <textarea id="txt_hobi" rows='3' class="form-control @error('hobi') is-invalid @enderror" name="hobi" required autocomplete="hobi" autofocus></textarea>

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
            @if($riwayatTes1)
                <div class="card-page">
                    <div id="page">
                        <!-- <div class="card-header">

                        </div> -->
                        <div class="card-body">
                        
                            <p>
                                Anda telah melakukan tes minat bakat pada
                                <b> {{$riwayatTes1->tanggal_mulai}} </b>(UTC +7) 
                                
                                <br>

                                Klaster minat Anda adalah <b>{{$riwayatTes1->klaster->nama}}</b>  
                                
                                @if($riwayatTes2->isNotEmpty())
                                    
                                    dan kategori klaster Anda:
                                        <ul>
                                            @foreach($riwayatTes2 as $dataKategori)
                                                <li><b>{{$dataKategori->nama_klaster}}</b></li>
                                                
                                            @endforeach
                                        </ul>
                                @else
                                    Silahkan Anda mengikuti ujian tahap 2 <a href="{{ $linkTes2 }}" target="_blank" class="btn btn-warning">di sini</a>
                                @endif
                            </p>
                        
                        
                        </div>
                    </div>
                </div>
            @endif
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

    @else
        <div class="portlet">
            <div class="portlet-body">
    
            <table class="table table-striped table-bordered table-hover dataTable no-footer" id="sample_1" role="grid" aria-describedby="sample_1_info">
                <thead>
                    <tr role="row">
                        <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" 
                            aria-label="Rendering engine: activate to sort column ascending" style="width: 129px;">
                                No
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" 
                        aria-label="Browser: activate to sort column ascending" style="width: 250px;">
                                Pertanyaan
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" 
                            aria-label="Rendering engine: activate to sort column ascending" style="width: 129px;">
                                Detail
                        </th>
                        
                        <th aria-controls="sample_1" tabindex="0" rowspan="1" colspan="1" style="width: 120px;">
                                Aksi
                        </th>
                        
                    </tr>
                </thead>
                
                <tbody>
                @php 
                    $no = 1;
                @endphp

                @foreach ($data as $key=>$item)
                {{-- <tr role="row" class="{{ ($key % 2 === 0) ? 'even' : 'odd' }}">--}}
                <tr role="row" class="{{ ($key % 2 === 0) ? 'active' : 'success' }}">
                    <td class="">
                        {{ $no }}
                    </td>
                    <td>
                        {{ $item->pertanyaan }}
                    </td>
                    
                    <td>
                        <a data-toggle='modal' data-target='#modal_{{$item->id}}' class="btn btn-default btn-xs btn-info"><i class="fa fa-eye"></i> View</a>
                    </td>
                    <td>
                    {{-- Button Edit --}}
                    <a href="#modalEdit" data-toggle='modal' class='btn btn-warning btn-xs' onclick="getEditForm({{$item->id}})">
                        Edit
                    </a>
                    <div class="modal fade" id="modalEdit" tabindex="-1" role="basic" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content" id='modalContent'></div>
                        </div>
                    </div> 

                    

                    {{-- Button Delete 2--}}
                    <a class="btn btn-default btn-danger btn-xs" data-toggle="modal" data-target="#deleteModal_{{$item->id}}">
                        Delete
                    </a>              
                    <form method='POST' action="{{ url('soal/'.$item->id) }}">
                        @csrf
                        @method('DELETE')
                        <div id="deleteModal_{{$item->id}}" class="modal fade" tabindex="-1" role="basic">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-body" style="text-align: center;">
                                        <div style="width: 60px; height: 60px; margin: auto;">
                                            <i style="font-size: 46px; color: #8a6d3b; margin-top: 10px;" class="glyphicon glyphicon-warning-sign"></i>
                                        </div>
                                        <p>
                                            Apakah Anda yakin ingin menghapus soal no <b>{{$no}}</b>?
                                        </p>
                                        <input type="hidden" name="old_id" value="{{ $item->id }}">
                                    </div>
                                    <div style="border-top: none; text-align: center;" class="modal-footer">
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                        <button type="button" data-dismiss="modal" class="btn btn-default">Batal</button>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    </td>
                </tr>

                <div class="modal fade" id="modal_{{$item->id}}" tabindex="-1" role="basic" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"><i style="font-size: 20px" class="fa fa-group"></i>Soal no {{$no}}</h4>  
                        </div>

                        <div class="modal-body">
                        <div class="form-group">
                            <label for="pertanyaan">Pertanyaan</label>
                            <textarea name="pertanyaan" class="form-control" disabled value='{{ $item->pertanyaan }}' rows="3" placeholder="Masukkan Pertanyaan" required>{{ $item->pertanyaan }}</textarea>
                        </div>
        
                        <div class="form-group">
                            <div class='row'>
                            <div class='col-md-8'>
                                <label for="jawaban">Jawaban</label>
                            </div>
                            <div class="col-md-4">
                                <label for="kejuruan">Klaster</label>
                            </div>
                            </div>

                            @php
                            $i = 0;
                            @endphp

                            @foreach($data2 as $d)
                            @if($d->question_id == $item->id)

                            <div class='row'>
                            <div class='col-md-8'>
                                <input type="text" class="form-control" disabled value='{{ $d->jawaban }}' id="jawaban" name="jawaban[{{ $i }}]" placeholder="Masukkan Pilihan {{ ($i+1) }}" required>
                            </div>
                            <div class="col-md-4">
                                <select class="form-control" name="kejuruan[{{ $i }}]" disabled required>
                                {{-- Belum fix. Tinggal di looping lagi sesuai table kejuruans --}}
        
                                @foreach($data3 as $e)
                                    @if($e->id == $d->klaster_id)
                                        <option value='{{ $d->klaster_id }}'>{{ $e->nama }}</option>
                                    
                                    @endif
                                @endforeach

                                </select>
                            </div>
                            </div><br>
                            @php
                            $i++;
                            @endphp
                            @endif
                            @endforeach
                        </div>
                        </div>
        
                        <div style="border-top: none; text-align: center;" class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                    </div>
                </div>
                @php
                    $no++;
                @endphp

                @endforeach
            </tbody>
            </table>
        
            </div>
        </div>    
    @endif
          
@endsection
    {{--</body>
</html>--}}
