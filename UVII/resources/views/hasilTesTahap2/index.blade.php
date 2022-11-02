@extends('layouts.index',['menu' => $menu_role])

@section('title')
   Hasil Tes Tahap 2
@endsection

@section('javascript')
    <script>
        setInterval(function() {
            
            $(".page-content-wrapper").load(location.href + " .page-content-wrapper");
         
        }, 5000);
    </script>
@endsection

@section('contents')
    <div class="card-page">
        <div class="card-body">
            <span class="label label-danger">NOTE!</span><br><br>
            <p>Proses perhitungan Minat Kejuruan memerlukan waktu sekitar <b>1 menit</b>.
                Silahkan melakukan <b>refresh pada layar atau tekan F5 pada keyboard</b> 
                apabila waktu tes kosong atau hasil tes tidak sesuai.
            </p>
        </div>   
    </div>

    <div class="card-page">
        <div class="card-header">
            <p><b>Hasil Tes Tahap 2</b></p>
        </div>
        <div class="card-body">
            <div class='row'>
                <div class='col-md-6'>
                    <label for="kejuruan"><b>Peringkat</b></label>
                </div>
                <div class="col-md-4">
                    <label for="kategori"><b>Kategori</b></label>
                </div>
                        
            </div>
            @foreach($hasil_Tes_2 as $data)
                        
                <div class='row'>
                    <div class='col-md-6'>
                                    
                        <p for="peringkat"><b>{{ $data->peringkat }}</b></p>
                                    
                    </div>
                    <div class="col-md-4">
                                
                        <p for="kategori">{{$data->nama}}</p>
                                
                    </div>
                </div>       

            @endforeach

            <br>
            <div>
                <p><b>Tanggal dan Waktu Tes Terakhir:</b></p>
            
                <p>
                    @php
                        echo date('d-m-Y h:i:s', strtotime($tanggal_tes->tanggal_mulai)).' - '.date('d-m-Y h:i:s', strtotime($tanggal_tes->tanggal_selesai));
                    @endphp
                </p>
            </div>
         
            <br>
            <div>
                <p><b>Hasil Psikometrik Tes Terakhir:</b></p>

                @foreach($hasil_Tes_2 as $data)
            
                    <label>
                        {{ $data->nama}}
                        @if(!$loop->last)
                            ,
                        @endif
                    </label>
            
                @endforeach
            </div>
         
            <br>
            <p>
                <b>Berikut adalah link <a href="https://bit.ly/EvaluasiTesMinatKerjaUVII" target=_blank class="btn btn-primary">Kuesioner</a> Evaluasi Tes Minat Kejuruan UVII. 
	            Mohon kesediaan untuk mengisi kuesioner tersebut.</b>
            </p>

        </div>
    </div>

@endsection