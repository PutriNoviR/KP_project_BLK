@extends('layouts.tesAwal')

@section('title')
    Uji Tahap Awal
@endsection

@section('contents')
<div class="container">
    <div class="timer" >
        <p>Time Left : 0:20:00</p>
    </div>

    <div class="body_test">

        @php
            $no = 1;
        @endphp

        @foreach($dataSoal as $data)
        <div class="soal">
           <p> {{ $no }}. {{ $data->pertanyaan }}</p>
           <input type="hidden" name="soal_{{ $no }}" value="{{ $data->id }}"> 
        </div>

        <div class="row_pilihan">

            @foreach($data->find($data->id)->jawaban->shuffle() as $pilihan)
            <div class="pilihan">
                
                <label>
                    <input type="radio" name="pilihan_jawaban_{{ $no }}" value="{{ $pilihan->idanswers }}"> 
                    {{ $pilihan->jawaban }}
                </label>
            </div>
            @endforeach
        </div>

        @php
            $no++;
        @endphp

        @endforeach
    </div>

    <div class="tes-btn">
        <a href="{{ route('peserta.uji.tahap.awal') }}" class="button btn btn-primary">Previous</a>
        <a href="{{ route('peserta.uji.tahap.awal') }}" class="button btn btn-primary">NEXT</a>
        
    </div>

    <div class="navigation">
        <div class="nav-title" >
            <p>Test Navigation</p>
        </div>
        
        <div class="line"></div>

        <div class="row">
            @for($i=1; $i <= $dataSoal->count(); $i++)
            <div class="box">
                <span>{{ $i }}</span>
            </div>
            @endfor
        </div>

        <div class="finish_attempt" >
            <a>Finish Attempt...</a>
        </div>
    </div>

</div>
@endsection

