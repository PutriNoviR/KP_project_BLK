@extends('layouts.tesAwal')

@section('title')
    Uji Tahap Awal
@endsection



@section('contents')
<div class="card-page">
            <div class="card-header">
                <p><b>Detail Jawaban Peserta</b></p>
            </div>
            <div class="card-body">
               
                <div class='row'>
                    
                    <div class='col-md-6'>
                        <label for="kejuruan"><b>Pertanyaan</b></label>
                    </div>
                    <div class="col-md-3">
                        <label for="score"><b>Jawaban Dipilih</b></label>
                    </div>
                    
                </div>

                    @php 
                        $no = 1;
                    @endphp
                        
                        @foreach($dataSoal as $key=>$data)
                           @if(isset($dataJawaban[$data->id]))
                                @php
                                    $rekapJawaban = $data->jawaban()->where('idanswers',$dataJawaban[$data->id])->first();
                                @endphp
                                
                                <div class="row {{ ($rekapJawaban == null) ? 'detailJawabanActive' : 'detailJawabanSuccess' }}">
                                
                                    <div class='col-md-6 row-pad'>
                                        
                                        <p for="soal">{{$no}}. {{ $data->pertanyaan }} ?</p>
                                        
                                    </div>
                                    <div class="col-md-3 row-pad">
                                        
                                        
                                        @if(!$rekapJawaban)
                                            <p for="jawaban">belum terisi</p>
                                        @else
                                           
                                                <p for="jawaban">{{$rekapJawaban->jawaban}}</p>
                                            
                                        @endif
                                    </div>
                                </div>
                            @endif

                            @php
                                $no++;
                            @endphp

                        @endforeach
                    </div>
              
                <div class="body-content-detail">
                    <p>Apakah Anda ingin mengakhiri pengerjaan tes tahap 1 ?<br>
                    Waktu tersisa
                        <b>{{ $menit }} menit {{ $detik}} detik</b>.
                    </p>
                </div>
                
                <div class="modal-btn">
                    <a href="{{route('peserta.uji.tahap.awal')}}" class="btn-default button btn">Kembali</a>
                    <a href="{{route('soal.hasilJawaban.score')}}" class="btn btn-primary button">Akhiri</a>
                </div>
                
            </div>


        </div>
@endsection