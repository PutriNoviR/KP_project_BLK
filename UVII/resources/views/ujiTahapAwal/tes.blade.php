@extends('layouts.tesAwal')

@section('title')
    Uji Tahap Awal
@endsection


@section('javascript')
<script>

    function closeModal(){
        $('#modalInfo').modal('hide');   
    }

    function startTimer(duration, display1, display2) {
        var timer = duration, minutes, seconds;
       
        setInterval(function () {
            minutes = parseInt(timer / 60, 10);
            seconds = parseInt(timer % 60, 10);

            //20:10
            //20:9

            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            if (--timer < 0) {
                // localStorage.clear("menit");
                // localStorage.clear("detik");
                minutes = "00";
                seconds = "00";
                $('#waktuHabisModal').modal('show',{backdrop:'static',keyboard:'false'});

            }
           
            $.ajax({
                type:'post',
                url:'{{ route("peserta.update.timer")}}',
                data:{'_token':'<?php echo csrf_token() ?>',
                    'menit':minutes,
                    'detik':seconds,
                },
                success: function(data){
                    // alert(data.msg);
                }
            });

            display1.textContent = minutes;
            display2.textContent = seconds;
              
                // localStorage.setItem("menit",minutes);
                // localStorage.setItem("detik",seconds);
            
        }, 1000);
    }

    window.onload = function () {
      
        $('#modalInfo').modal('show');
    
        // pengecekan apakah boleh klik next atau tidak
        if($('input[type=radio]').is(':checked') == true){
            $('#btnNext').css('pointer-events', 'true');
            $('#btnSubmit').css('pointer-events', 'true');
        }
        else{
            $('#btnNext').css('pointer-events', 'none');
            $('#btnSubmit').css('pointer-events', 'none');
        }

        var menit = parseInt($('#menit').html());
        var detik = parseInt($('#detik').html());
 
        // var menit = parseInt('');
        // var detik = parseInt('');
        // if(localStorage.getItem("menit") && localStorage.getItem("detik")){
        //    menit =  parseInt(localStorage.getItem("menit"));
        //    detik =  parseInt(localStorage.getItem("detik"));
        // }
      
        // ubah ke satuan detik
        var time = (60 * menit) + detik,
            display1 = document.querySelector('#menit'), 
            display2 = document.querySelector('#detik');

        if(time > 0){
            startTimer(time, display1, display2);
        }  
        else{
            setInterval(function () {
                $('#waktuHabisModal').modal('show',{backdrop:'static',keyboard:'false'});
 
            },1000);

            window.onload = disableBack();

            window.onpageshow = function(e) {
                if (e.persisted)
                    disableBack();
            }
        } 
        
        function disableBack() {
            window.history.forward()
        }
    }

    $("input[type=radio]").click(function(){
        var idJawaban = $(this).val();
        var idx = $(this).attr('id_soal');
        var idSoal = $("input[name=soal_"+ idx +"]").val();
        var no_soal = $(this).attr('no_soal');

        $.ajax({
            type:'post',
            url:'{{ route("peserta.save.jawaban")}}',
            data:{'_token':'<?php echo csrf_token() ?>',
                'soal':idSoal,
                'jawaban':idJawaban,
            },
            success: function(data){
                if(data.msg != ""){
                    $('#btnNext').css('pointer-events', 'true');
                    $('#btnSubmit').css('pointer-events', 'true');
                    $('#box_' + no_soal).css('background', '#D9D9D9')
                }
            }
        });

    });

    function getSelectedQuestion(no, perPage){
        var page = Math.floor(((no-1)/perPage)+1);
       
        // get current url browser
        var url = new URLSearchParams(window.location.search);
        // set new parameter
        url.set('page', page);
       
        // replace url browser with new parameter
        history.replaceState(null, null, "?"+url.toString()); 
        // reload page with new parameter
        document.location.href="?"+url.toString();
    }
   
</script>
@endsection

@section('contents')
{{--foreach untuk menampilkan data setting--}}
@php

    $page = ((!isset($_GET['page']) || empty($_GET['page']) )? 1:$_GET['page']);

    $lastNumber = ($page-1)*$perPage;

@endphp

{{--@if(Session::has('error'))
   
    <div id='modalInfo' class="modal" tabindex="-1" role="basic">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body" style="text-align: center;">
                    <div style="width: 60px; height: 60px; margin: auto;">
                        <i style="font-size: 46px; color: #8a6d3b; margin-top: 10px;" class="glyphicon glyphicon-info-sign"></i>
                    </div>
                    <p>
                       {{ Session::get('error') }}
                    </p>
                    
                </div>
                <div style="border-top: none; text-align: center;" class="modal-footer">
                    <a class="btn btn-default" onclick="closeModal()">OK</a>
                </div>
            </div>
        </div>
    </div>

@endif--}}

<div class="container">
    <div class="timer" >
        <p>Time Left &nbsp;
            <span id="time">
                <span id="menit">{{ $waktu1 }}</span> : 
                <span id="detik">{{ $waktu2 }}</span>
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
                    
                        <input type="radio" name="jawaban_{{ $data->id }}" id_soal="{{$data->id}}" no_soal="{{ $cornerData }}" value="{{ $pilihan->idanswers }}" {{ ($dataJawaban[$data->id] == $pilihan->idanswers) ? 'checked':'' }}> 
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
        <a href="{{ $dataSoal->previousPageUrl() }}" id='btnPrevious' class="button btn btn-primary" style="{{ $dataSoal->previousPageUrl() == null ? 'visibility:hidden;':''}}">Previous</a>
      
        @if($dataSoal->nextPageUrl() == null)
            {{--<a href="{{ route('soal.hasilJawaban.score') }}" id='btnSubmit' class="button btn btn-primary">SUBMIT</a>--}}
            <a href="{{ route('soal.detail.jawaban') }}" id='btnSubmit' class="button btn btn-primary">SUBMIT</a>
        @else
            <a href="{{ $dataSoal->nextPageUrl()}}" id='btnNext' class="button btn btn-primary">NEXT</a>
        @endif


    </div>

    <div class="navigation">
        <div class="nav-title" >
            <p>Test Navigation</p>
        </div>
        
        <div class="line"></div>

        <div class="row">
          {{--  @for($i=1; $i <= $totalSoal; $i++) --}}
            @php
                $no = 1;
            @endphp
            @foreach($dataJawaban as $data)
                <div id="box_{{ $no }}" class="{{ $data != 0 ? 'box answered':'box' }}" onclick="getSelectedQuestion({{$no}},{{$perPage}})">
                    <span>{{ $no }}</span>
                </div>
              @php
                $no++;
              @endphp
            @endforeach
           
           {{-- @endfor --}}
        </div>

        <div class="finish_attempt" >
            {{--<a href="{{ route('soal.hasilJawaban.score') }}">Finish Attempt...</a>--}}
            <a href="{{ route('soal.detail.jawaban') }}">Finish Attempt...</a>
        </div>
    </div>

    
    <div id="waktuHabisModal" class="modal fade" tabindex="-1" role="basic">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body" style="text-align: center;">
                    <div style="width: 60px; height: 60px; margin: auto;">
                        <i style="font-size: 46px; color: #8a6d3b; margin-top: 10px;" class="glyphicon glyphicon-warning-sign"></i>
                    </div>
                    <p>
                        Waktu pengerjaan habis!
                    </p>
                    
                </div>
                <div style="border-top: none; text-align: center;" class="modal-footer">
                    <a class="btn btn-danger" href="{{ route('soal.hasilJawaban.score') }}">OK</a>
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

