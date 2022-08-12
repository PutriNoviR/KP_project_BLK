@extends('layouts.tesAwal')

@section('title')
    Uji Tahap Awal
@endsection

@php
session_start();
    if((!isset($_SESSION['menit'])) || empty($_SESSION['menit'])){
        $_SESSION['menit'] = "20";
        $_SESSION['detik']="00";
    }
   

@endphp

@section('javascript')
<script>
    function startTimer(duration, display1, display2) {
        var timer = duration, minutes, seconds;
       
        setInterval(function () {
            minutes = parseInt(timer / 60, 10);
            seconds = parseInt(timer % 60, 10);

            //20:10
            //20:9

            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            display1.textContent = minutes;
            display2.textContent = seconds;

            if (--timer < 0) {
                localStorage.clear("menit");
                localStorage.clear("detik");
                display1.textContent ="00";
                display2.textContent= "00";
                //timer = duration;
            }
            else{
                localStorage.setItem("menit",minutes);
                localStorage.setItem("detik",seconds);
            }
        }, 1000);
    }

    window.onload = function () {
        var menit = parseInt($('#menit').html());
        var detik = parseInt($('#detik').html());
 
        // var menit = parseInt('');
        // var detik = parseInt('');
        if(localStorage.getItem("menit") && localStorage.getItem("detik")){
           menit =  parseInt(localStorage.getItem("menit"));
           detik =  parseInt(localStorage.getItem("detik"));
        }
      
        // ubah ke satuan detik
        var minutes = (60 * menit) + detik,
            display1 = document.querySelector('#menit'), 
            display2 = document.querySelector('#detik');

        if($('#menit').html()!= "00"){
            startTimer(minutes, display1, display2);
        }    
        else{
            alert('waktu habis');
        }         
    };

    $("input[type=radio]").click(function(){
        var idJawaban = $(this).val();
        var idx = $(this).attr('id_soal');
        var idSoal = $("input[name=soal_"+ idx +"]").val();

        $.ajax({
            type:'post',
            url:'{{ route("peserta.save.jawaban")}}',
            data:{'_token':'<?php echo csrf_token() ?>',
                'soal':idSoal,
                'jawaban':idJawaban,
            },
            success: function(data){
                // alert(data.msg);
            }
        });

    });
</script>
@endsection

@section('contents')
@php


    $page = ((!isset($_GET['page']) || empty($_GET['page']) )? 1:$_GET['page']);

    $lastNumber = ($page-1)*3;


@endphp

<div class="container">
    <div class="timer" >
        <p>Time Left &nbsp;
            <span id="time">
                <span id="menit">20</span> : 
                <span id="detik">00</span>
            </span>
        </p>
    </div>

    <div class="body_test">

        {{--@for($i=0; $i<$totalSoal; $i++)--}}

        @php
            $cornerData = 1;
        @endphp
        
       @foreach($dataSoal as $data)
        @php 
             $cornerData;
        @endphp

        <div class="soal">
           <p> 
            @php
                echo ($lastNumber+$cornerData);
            @endphp
            . {{ $data->pertanyaan }}
        </p>
           <input type="hidden" name="soal_{{ $data->id }}" value="{{ $data->id }}"> 
        </div>

        <div class="row_pilihan">

            @foreach($data->find($data->id)->jawaban->shuffle() as $pilihan)
            <div class="pilihan">
                
                <label>
                    <input type="radio" name="jawaban[{{ $data->id }}]" id_soal="{{$data->id}}" value="{{ $pilihan->idanswers }}" > 
                    {{ $pilihan->jawaban }}
                </label>

            </div>
               
            @endforeach
        </div>
       {{-- @php
            $_SESSION['no']=$_SESSION['no']+1;
        @endphp --}} 

        @php
            $cornerData++;
        @endphp

        @endforeach 
        {{--@endfor--}}
    </div>
  {{--  {{$_SESSION['no']}} --}}

    <div class="tes-btn">
        <a href="{{ $dataSoal->previousPageUrl() }}" class="button btn btn-primary" style="{{ $dataSoal->previousPageUrl() == null ? 'visibility:hidden;':''}}">Previous</a>
      
        @if($dataSoal->nextPageUrl() == null)
            <a href="{{ route('peserta.uji.tahap.awal') }}" class="button btn btn-primary">SUBMIT</a>

        @else
            <a href="{{ $dataSoal->nextPageUrl()}}" class="button btn btn-primary">NEXT</a>
        @endif


    </div>

    <div class="navigation">
        <div class="nav-title" >
            <p>Test Navigation</p>
        </div>
        
        <div class="line"></div>

        <div class="row">
            @for($i=1; $i <= $totalSoal; $i++)
            <div class="box">
                <span>{{ $i }}</span>
            </div>
            @endfor
        </div>

        <div class="finish_attempt" >
            <a >Finish Attempt...</a>
        </div>
    </div>

</div>
@endsection
