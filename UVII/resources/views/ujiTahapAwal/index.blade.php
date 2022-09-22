@extends('layouts.index',['menu' => $menu_role])

@section('title')
    Tes Tahap 1
@endsection

@section('javascript')
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        let setting = null
        $(document).ready(function(){
            setting = "<?php echo $settingValidasi[0]->value;?>"
        if(setting == 1){
            Webcam.set({
                width: 490,
                height: 350,
                image_format: 'jpeg',
                align:'center',
                jpeg_quality: 90
            });

            Webcam.attach( '#my_camera' );
        }
        $('#btn-capture').on('click',function(){

            Webcam.snap( function(data_uri) {
                // $(".image-tag").val(data_uri);
                    let photo = data_uri;
                    console.log(photo)
                    $.ajax({
                        type: "POST",
                        url: "{{ route('capture') }}",
                        data: {
                            '_token': '<?php echo csrf_token(); ?>',
                            'image' : photo
                        },
                        success: function(data) {
                            if(data.msg = "Berhasil"){
                                alert('yey berhasil')
                                $('.btn-mulai').prop("disabled", false)
                            }
                            else
                            {
                                $('.btn-mulai').prop("disabled", true)
                            }
                        }
                    });
            } );
        })


        })
        function show(){
            $('#modalTes').css('display', 'block');
            $('#page').css('filter', 'blur(4px)');
        }

        function unshow(){
            $('#modalTes').css('display', 'none');
            $('#page').css('filter', 'blur(0)');
        }



    </script>
@endsection

@section('page-bar')
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="{{route('home')}}">Dashboard</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="{{route('peserta.tes')}}">Tes Tahap 1</a>
            <i class="fa fa-angle-right"></i>
        </li>
    </ul>
@endsection

@section('contents')
        <div class="card-page">
            <div id="page">
                <div class="card-header">
                    <p>Tes Minat Kejuruan</p>
                </div>

                <div class="card-body">
                    <div class="body-title" >
                        <p>Hal Penting tentang Tes Minat Kejuruan:</p>
                    </div>
                    <div class="body-content">
                    @if($settingValidasi[0]->value == 1)
                        <div class='container'>
                            <!-- <h1 class="text-center">Tolong perlihatkan wajah ke kamera.</h1> -->
                            <form action="">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div style='min-width:100; min-height:100;' id="my_camera"></div>
                                        <br/>
                                        <!-- <input type=button value="Take Snapshot" onClick="capture()"> -->
                                        <!-- <input type="hidden" name="image" class="image-tag"> -->
                                            <button type='button' id='btn-capture' class="btn btn-success" >capture</button>
                                    </div>
                                    <!-- <div class="col-md-6">
                                        <div id="results">Your captured image will appear here...</div>
                                    </div> -->
                                </div>
                            </form>
                        </div>
                    @endif
                        <ul class="tulisan_rata">
                            <li>
                            Tes minat kejuruan ini akan memberikan masukan mengenai kejuruan dari pelatihan yang nantinya dapat Anda ambil di Balai Latihan Kerja (BLK).
                            </li>
                            <li>
                            Anda akan dihadapkan pada pernyatan-penyataan yang berisi berbagai aktivitas kerja dan Anda diminta untuk memilih salah satu aktivitas kerja yang paling Anda sukai terlepas dari jumlah penghasilan yang akan Anda peroleh dari aktivitas tersebut juga terlepas dari apakah Anda sudah memiliki keahlian untuk melakukan aktivitas tersebut. Pilihlah aktivitas yang memang benar-benar Anda sukai.
                            </li>
                            <li>
                            Ketika mengerjakan tes ini, Anda diminta untuk menjawab seluruh pertanyaan-pertanyaan yang diberikan. Semua jawaban adalah benar sejauh Anda menjawab sesuai kondisi diri Anda. Anda tidak perlu khawatir, karena tidak ada jawaban yang salah.
                            </li>
                            <li>
                            Anda diminta untuk mengerjakan soal-soal tes dalam waktu yang kami sediakan sesuai dengan instruksi.  Selama pengerjaan Anda dapat kembali ke soal sebelumnya.
                            </li>

                        </ul>
                    </div>

                    <div class="body-btn">
                        <p>
                            Silahkan menekan tombol <b>Mulai Tes</b> jika merasa sudah siap. Selamat mengerjakan tes.
                        </p>

                        @if($tes == null)
                            <button type="button" class="btn btn-primary btn-mulai" <?php if($settingValidasi[0]->value==1) echo "disabled"  ?>  onclick="show()">
                                Mulai Tes
                            </button>
                        @else
                            <a href="{{ route('peserta.uji.tahap.awal') }}" class="button btn btn-primary btn-mulai" <?php if($settingValidasi[0]->value==1) echo "disabled"  ?>>Lanjut Tes</a>
                        @endif

                    </div>
                </div>

            </div>

            <div id="modalTes">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body" style="text-align: center;">
                            <div class="modal-body-icon">
                                <i class="glyphicon glyphicon-warning-sign"></i>
                            </div>
                            <p>
                                Waktu akan berjalan setelah kalian menekan tombol <b>Mulai</b>.
                            </p>
                            <p>
                                Pastikan menyelesaikan soal tepat waktu.
                            </p>
                        </div>

                        <div class="modal-btn">
                            <a href="{{ route('peserta.uji.tahap.awal') }}" class="button btn btn-primary">Mulai</a>
                            <button type="button" class="btn btn-default" onclick="unshow()">Kembali</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
