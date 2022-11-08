@extends('layouts.index',['menu' => $menu_role])

@section('title')
    Review Attempt Peserta
@endsection

@section('contents')
    <div class="card-page">
        <div class="card-header">
            <p><b>Review Tes Peserta</b></p>
        </div>

        <div class="card-body">
           
            <p>Berikut adalah detail test <b>{{$data->nama_depan}} {{$data->nama_belakang}}</b> dengan email <b>{{$data->email}}</b> berusia <b>{{$usia}}</b> tahun.</p>
            <p>Memiliki Hobi <b>{{$data->hobi}}</b>, Pendidikan terakhirnya adalah <b>{{$data->pendidikan_terakhir}}({{$data->konsentrasi_pendidikan}})</b>.</p><br>
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#tab_1" data-toggle="tab">Tes Tahap 1</a>
                </li>
                <li class="">
                    <a href="#tab_2" data-toggle="tab">Tes Tahap 2</a>
                </li>  
            </ul>   
            <!-- tab 1 -->
            <div class="tab-pane fade active in" id="tab_1">
                <P>Tanggal dan Waktu pengerjaan tes <b>@php
                        echo date('d M Y h:i:s', strtotime($tgl->tanggal_mulai)).' - '.date('d M Y h:i:s', strtotime($tgl->tanggal_selesai));
                    @endphp</b></p>
                    <p>Durasi Pengerjaan selama <b> {{$waktu1}}</b> menit <b>{{$waktu2}}</b> detik</p><br>

                <p><b>Hasil Tes Minat Bakat:</b></p>

                <div class='row detailJawabanActive'>
                    <div class='col-md-6'>
                        <label for="kejuruan"><b>Nama Klaster</b></label>
                    </div>
                    <div class="col-md-4">
                        <label for="score"><b>Score</b></label>
                    </div>

                </div>

                    @php
                        $no = 1;
                    @endphp

                    @foreach($dataHasilTes as $key=>$data)

                        <div class="row detailJawabanActive">
                            <div class='col-md-6'>

                                <p for="kejuruan">{{$no}}. {{ $data['klaster'] }}</p>

                            </div>
                            <div class="col-md-4">

                                <p for="score">{{$data['score']}}</p>

                            </div>
                        </div>

                        @php
                            $no++;
                        @endphp

                    @endforeach

                    <br><p><b>Rekap Jawaban Peserta:</b></p>

                    <div class='row detailJawabanSuccess'>
                        
                        <div class='col-md-6'>
                            <label for="kejuruan"><b>Pertanyaan</b></label>
                        </div>
                        <div class="col-md-3">
                            <label for="score"><b>Jawaban</b></label>
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
                                    
                            <div class="row detailJawabanSuccess">
                            
                                <div class='col-md-6 row-pad'>
                                    
                                    <p for="soal">{{$no}}. {{ $data->pertanyaan }} ?</p>
                                    
                                </div>
                                <div class="col-md-3 row-pad">
                                    
                                    @if(!$rekapJawaban)
                                        <p for="jawaban">belum terisi</p>
                                    @else
                                        
                                        <p for="jawaban">{{$rekapJawaban->jawaban}}</p>
                                        @foreach($dataKlaster as $k)
                                            @if($rekapJawaban->klaster_id == $k->id)
                                                <div class="emblem label-info">
                                                    <span>{{$k->nama}}</span>
                                                </div>
                                            @endif
                                        @endforeach

                                    @endif
                                </div>
                            </div>

                            @php
                                $no++;
                            @endphp
                        @endif

                    @endforeach
                    
                    @if($jumKlaster > 1 && $tgl->tanggal_selesai != null)
                        
                        <div class="row detailJawabanSuccess">
                                
                            <div class='col-md-6 row-pad'>
                                
                                <p for="soal">{{$no}}. Pilihlah aktivitas yang paling Anda minati dari pilihan jawaban berikut!</p>
                                
                            </div>
                            <div class="col-md-3 row-pad">
                                @foreach(array_slice($dataHasilTes, 0,1) as $d)
                                    <p for="jawaban">{{$d['klaster']}}</p>
                                    
                                    <div class="emblem label-info">
                                        <span>{{$d['klaster']}}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    
                        <span class="label label-danger">NOTE!</span>
                        Terdapat hasil yang sama, sehingga muncul soal tambahan pada nomor {{$no}}.
                    @endif
            </div> 

            <!-- tab 2 -->
            <div class="tab-pane fade active in" id="tab_2">

            </div>

            <div class="modal-btn">
                @php
                    $role_user = strtolower(Auth::user()->role->nama_role);
                @endphp

                @if($role_user != 'peserta')
                    <a href="{{route('riwayat_tes_global.user')}}" class="btn-default button btn">Kembali</a>
                @else
                    <a href="{{route('riwayat_tes.user')}}" class="btn-default button btn">Kembali</a>
                @endif
            </div>
        </div>
    </div>
@endsection