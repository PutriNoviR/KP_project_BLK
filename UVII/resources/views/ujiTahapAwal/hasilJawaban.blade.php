@extends('layouts.index')

@section('title')
   Hasil Jawaban
@endsection

@section('contents')
   
    @if($klasters > 1 && $tesTerbaru->score == null)
        {{-- Munculkan soal lagi --}}
        <div class="card-page">
            <div class="portlet-body form">
                <p>
                    <span class="label label-danger">NOTE!</span>
                    Dikarenakan terdapat hasil yang sama, mohon menjawab pertanyaan tambahan di bawah ini.
                </p>
             
            </div>

            <div class="card-body">
                <form method='post' action='{{ route("soal.tambahan.score") }}'>
                    @csrf
                    <div class="soal">
                        <p> 
                            1. Pilihlah aktivitas yang paling Anda minati dari pilihan jawaban berikut!
                        </p>
                    </div>

                    <div class="row_pilihan">
                    
                        @foreach($dataKlaster as $d)
                            <div class="pilihan">  
                                <label>
                    
                                    <input type="radio" name="jawaban" value="{{ $d->id }}" required> 
                                    {{ $d->nama }}

                                </label>
                            
                            </div>
                        @endforeach
                    
                    </div>

                    <div class="body-btn">
                        <input type="submit" class="btn btn-primary button">
                    </div>
                </form>
            </div>
        </div>
    @else
        <div class="card-page">
            <div class="card-header">
                <p> <b>Hasil Tes Minat Peserta</b></p>
            </div>
            <div class="card-body">
                <p><b>Analisa Tes Minat Bakat:</b></p>
                
                <div class='row'>
                    <div class='col-md-6'>
                        <label for="kejuruan"><b>Nama Klaster</b></label>
                    </div>
                    <div class="col-md-4">
                        <label for="score"><b>Score</b></label>
                    </div>
                    
                </div>

                @foreach($dataHasil as $key=>$data)
                    
                    <div class='row'>
                        <div class='col-md-6'>
                            
                            <p for="kejuruan">{{++$key}}. {{ $data->klaster }}</p>
                            
                        </div>
                        <div class="col-md-4">
                            @if($data->id == $tesTerbaru->klaster_id && $data->score != $tesTerbaru->score)
                                <p for="score">{{$tesTerbaru->score}}</p>
                            @else
                                <p for="score">{{$data->score}}</p>
                            @endif
                        </div>
                    </div>
                   
                @endforeach
                <br>
                @foreach($dataHasil->take(1) as $d) 
                    
                    <p>Kesimpulan Tes Minat Bakat: </p><br>
                    @if((($d->id == $tesTerbaru->klaster_id && $data->score != $tesTerbaru->score) || ($d->id != $tesTerbaru->klaster_id && $data->score != $tesTerbaru->score)) && $dataKlaster != null)
                        
                        @foreach($dataHasil->where('id',$tesTerbaru->klaster_id) as $d2)
                                    
                        <p>Berikut kami sampaikan hasil tes dari peserta {{ Auth::user()->nama_depan.' '.Auth::user()->nama_belakang }}. Berdasarkan hasil tes minat Anda,
                            sistem telah menentukan kejuruan yang cocok dengan minat bakat Anda. Kejuruan itu adalah
                            <b>
                            {{$d2->klaster}}
                                
                            </b>
                            dengan total score yang diperoleh sebesar {{ $tesTerbaru->score }} dari pengerjaan {{ $totalScore}} soal umum dan 1 soal tambahan dalam waktu {{ $waktu1 }} menit {{ $waktu2}} detik.
                        </p>

                        <br>

                        <div class="modal-body-icon" style="text-align: center;">
                            <i class="glyphicon glyphicon-warning-sign"></i>
                        </div>
                        <p>Tahap ini belum selesai. Silahkan klik tombol <b>Lanjut Tes</b> untuk menentukan rekomendasi pelatihan yang sesuai minat Anda.</p>
                        
                        <div class="body-btn">
                            <a href="{{$d2->link}}" class="btn btn-primary button" >Lanjut</a>
                        </div>
                        @endforeach
                    @else
                        <p>Berikut kami sampaikan hasil tes dari peserta {{ Auth::user()->nama_depan.' '.Auth::user()->nama_belakang }}. Berdasarkan hasil tes minat Anda,
                            sistem telah menentukan kejuruan yang cocok dengan minat bakat Anda. Kejuruan itu adalah<b> {{$d->klaster}} </b>
                            dengan total score yang diperoleh sebesar {{ $d->score }} dari pengerjaan {{ $totalScore}} soal dalam waktu {{ $waktu1 }} menit {{ $waktu2}} detik.
                            
                        </p>
                        
                        <br>

                        <div class="modal-body-icon" style="text-align: center;">
                            <i class="glyphicon glyphicon-warning-sign"></i>
                        </div>
                        <p>Tahap ini belum selesai. Silahkan klik tombol <b>Lanjut Tes</b> untuk menentukan rekomendasi pelatihan yang sesuai minat Anda.</p>
                        
                        <div class="body-btn">
                            <a href="{{$d->link}}" class="btn btn-primary button" >Lanjut</a>
                        </div>
                    @endif

                @endforeach
            </div>


        </div>
    @endif

@endsection

