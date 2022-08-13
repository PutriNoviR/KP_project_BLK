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
                    <label for="kejuruan"><b>Nama Kejuruan</b></label>
                </div>
                <div class="col-md-4">
                    <label for="score"><b>Score</b></label>
                </div>
                
            </div>

            @foreach($dataHasil as $key=>$data)
            <div class='row'>
                <div class='col-md-6'>
                    
                    <p id="kejuruan">{{++$key}}.{{ $data->kejuruan }}</p>
                    
                </div>
                <div class="col-md-4">
                    
                    <p for="score">{{$key}}. {{$data->score}}</p>
                  
                </div>
            </div>
            @endforeach
            <br>
        
            <p>Kesimpulan Tes Minat Bakat: </p><br>
            <p>Beikut kami sampaikan hasil tes dari peserta Sara. Berdasarkan hasil tes minat Anda,
                sistem telah menentukan kejuruan yang cocok dengan minat bakat Anda. Kejuruan itu adalah<b> @foreach($dataHasil->take(1) as $d) {{$d->kejuruan}} @endforeach</b>.
                dengan total score yang diperoleh sebesar 2 dari pengerjaan 2 soal dalam waktu 19 menit 40 detik.
                
            </p>
            <div class="modal-body-icon" style="text-align: center;">
                <i class="glyphicon glyphicon-warning-sign"></i>
            </div>
            <p>Tahap ini belum selesai. Silahkan klik tombol <b>Lanjut Tes</b> untuk menentukan pelatihan yang sesuai minat Anda.</p>
            
            <div class="body-btn">
                <button type="submit" class="btn btn-primary" >Lanjut</button>
            </div>
        </div>


    </div>


@endsection

