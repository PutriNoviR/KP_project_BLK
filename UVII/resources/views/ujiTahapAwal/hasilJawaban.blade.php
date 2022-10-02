@extends('layouts.index',['menu' => $menu_role])

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
                        <input type="submit" class="btn btn-primary button" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    @else
        
        @if($settingValidasi[0]->value == 0 || $tesTerbaru->is_validate == 1)
            <div class="card-page">
                <div class="card-header">
                    <p> <b>Hasil Tes Minat Peserta</b></p>
                </div>
                <div class="card-body">
                    <!-- <div id="my_camera"></div> -->
                    <p><b>Analisa Tes Minat Bakat:</b></p>

                    <div class='row'>
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

                        @foreach($dataHasilTerbaru as $key=>$data)

                            <div class='row'>
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


                    <br>
                    @foreach(array_slice($dataHasilTerbaru, 0,1) as $d)

                        <p>Kesimpulan Tes Minat Bakat: </p><br>

                            <p>Berikut kami sampaikan hasil tes dari peserta {{ Auth::user()->nama_depan.' '.Auth::user()->nama_belakang }}. Berdasarkan hasil tes minat Anda,
                                sistem telah menentukan kejuruan yang cocok dengan minat bakat Anda. Kejuruan itu adalah
                                <b>
                                {{$d['klaster']}}

                                </b>
                                dengan total score yang diperoleh sebesar {{ $d['score'] }} dari pengerjaan {{ $totalScore}} soal umum

                                @if($dataKlaster != null)
                                    dan 1 soal tambahan
                                @endif

                                dalam waktu {{ $waktu1 }} menit {{ $waktu2}} detik.
                            </p>

                            <br>

                            <div class="modal-body-icon" style="text-align: center;">
                                <i class="glyphicon glyphicon-warning-sign"></i>
                            </div>
                            <p>Tahap ini belum selesai. Silahkan klik tombol <b>Lanjut Tes</b> untuk menentukan rekomendasi pelatihan yang sesuai minat Anda.</p>

                            <div class="body-btn">
                                <a href="{{$d['link']}}" class="btn btn-primary button"  id="btn-lanjut" >Lanjut</a>
                            </div>

                    @endforeach
                </div>



            </div>
        @else
            <div class='card-page'>
                <div class='card-body'>
                <div id="my_camera"></div>
                    <p>Silahkan menunggu admin untuk melakukan validasi terlebih dahulu sebelum melanjutkan test ke tahap 2, jangan lupa untuk refresh halaman untuk mendapatkan hasil validasi</p>
                </div>
            </div>
        @endif
        <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                <script>
                let setting = null
                let valid = null
                $(document).ready(function(){
                
                    setting = "<?php echo $settingValidasi[0]->value;?>"
                    valid = "<?php echo $tesTerbaru->is_validate ?>"
                    if(setting==1 && valid ==0){

                        Webcam.set({
                            width: 490,
                            height: 350,
                            image_format: 'jpeg',
                            jpeg_quality: 90
                        });
                        Webcam.attach( '#my_camera' );
                            // alert('dor');
                        setTimeout(function() {
                                Webcam.snap( function(data_uri) {
                                // alert('dar');
                                let photo = data_uri;
                                // console.log(photo)
                                $.ajax({
                                    type: "POST",
                                    url: "{{ route('capture.akhir') }}",
                                    data: {
                                        '_token': '<?php echo csrf_token(); ?>',
                                        'image' : photo
                                    },
                                    success: function(data) {
                                        if(data.msg = "Berhasil"){
                                            $('#btn-lanjut').prop("disabled", false)
                                            alert('yey berhasil')
                                        }
                                        else
                                        {
                                            $('#btn-lanjut').prop("disabled", true)
                                        }
                                    }
                                });
                            } );
                        }, 3000);
                    }

                });
              
                </script>
    @endif

@endsection

