@extends('layouts.index')

@section('title')
   Hasil Jawaban
@endsection

@section('contents')
   

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
                    
                    <p id="kejuruan">{{++$key}}. {{ $data->klaster }}</p>
                    
                </div>
                <div class="col-md-4">
                    
                    <p for="score">{{$data->score}}</p>
                  
                </div>
            </div>
            @endforeach
            <br>
            @foreach($dataHasil->take(1) as $d) 
                <p>Kesimpulan Tes Minat Bakat: </p><br>
                <p>Beikut kami sampaikan hasil tes dari peserta {{ Auth::user()->nama_depan.' '.Auth::user()->nama_belakang }}. Berdasarkan hasil tes minat Anda,
                    sistem telah menentukan kejuruan yang cocok dengan minat bakat Anda. Kejuruan itu adalah<b> {{$d->klaster}} </b>
                    dengan total score yang diperoleh sebesar {{ $d->score }} dari pengerjaan {{ $totalScore}} soal dalam waktu {{ $waktu1 }} menit {{ $waktu2}} detik.
                    
                </p>
           
            <div class="modal-body-icon" style="text-align: center;">
                <i class="glyphicon glyphicon-warning-sign"></i>
            </div>
            <p>Tahap ini belum selesai. Silahkan klik tombol <b>Lanjut Tes</b> untuk menentukan rekomendasi pelatihan yang sesuai minat Anda.</p>
            
            <div class="body-btn">
                <a href="{{$d->link}}" class="btn btn-primary button" >Lanjut</a>
            </div>
            @endforeach
        </div>


    </div>


@endsection

