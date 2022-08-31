@extends('layouts.index',['menu' => $menu_role])

@section('title')
    Tes Tahap 1
@endsection

@section('javascript')
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
    <script>
        function show(){
            $('#modalTes').css('display', 'block');
            $('#page').css('filter', 'blur(4px)');
        }

        function unshow(){
            $('#modalTes').css('display', 'none');
            $('#page').css('filter', 'blur(0)');
        }

        Webcam.set({
        width: 490,
        height: 350,
        image_format: 'jpeg',
        jpeg_quality: 90
    });

    Webcam.attach( '#my_camera' );

    function capture() {
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
                            $('#btn-mulai').prop("disabled", false)
                        }
                        else
                        {
                            $('#btn-mulai').prop("disabled", true)
                        }
                    }
                });

        } );
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
                    <p>Tes Minat Bakat</p>
                </div>

                <div class="card-body">
                    <div class="body-title" >
                        <p>Hal Penting tentang Tes Minat Bakat:</p>
                    </div>
                    <div class="body-content">
                    <div class='container'>
                        <!-- <h1 class="text-center">Tolong perlihatkan wajah ke kamera.</h1> -->
                        <form action="">
                            <div class="row">
                                <div class="col-md-6">
                                    <div id="my_camera"></div>
                                    <br/>
                                    <!-- <input type=button value="Take Snapshot" onClick="capture()"> -->
                                    <!-- <input type="hidden" name="image" class="image-tag"> -->
                                    <button type='button' class="btn btn-success" onClick="capture()">capture</button>
                                </div>
                                <!-- <div class="col-md-6">
                                    <div id="results">Your captured image will appear here...</div>
                                </div> -->
                            </div>
                        </form>


                    </div>
                        <ul class="tulisan_rata">
                            <li>Tolong perlihatkan wajah ke kamera.</li>
                            <li>
                                Tes minat bakat akan menentukan kejuruan dari pelatihan yang nantinya kalian ambil.
                            </li>
                            <li>
                                Ketika mengikuti tes ini, kalian harus menyelesaikan beberapa soal dalam bentuk
                                    pilihan ganda dan harus diselesaikan dalam waktu yang telah disediakan.
                                    Selama pengerjaan kalian dapat kembali ke soal sebelumnya.
                            </li>
                            <li>
                                Silahkan menekan tombol <b>Mulai Tes</b> jika merasa sudah siap.
                            </li>
                        </ul>
                    </div>

                    <div class="body-btn">
                        @if($tes == null)
                            <button type="button" class="btn btn-primary" id='btn-mulai' disabled onclick="show()">
                                Mulai Tes
                            </button>
                        @else
                            <a href="{{ route('peserta.uji.tahap.awal') }}" class="button btn btn-primary">Lanjut Tes</a>
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
