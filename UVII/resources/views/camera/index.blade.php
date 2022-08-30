@extends('layouts.index')

@section('title')
    Camera
@endsection

<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
</head>

@section('contents')

<div class='container'>
    <h1 class="text-center">Tolong perlihatkan wajak ke kamera.</h1>
    <form action="">
        <div class="row">
            <div class="col-md-6">
                <div id="my_camera"></div>
                <br/>
                <input type=button value="Take Snapshot" onClick="capture()">
                <input type="hidden" name="image" class="image-tag">
            </div>
            <!-- <div class="col-md-6">
                <div id="results">Your captured image will appear here...</div>
            </div> -->
            <div class="col-md-12 text-center">
                <br/>
                <button class="btn btn-success">capture</button>
                <a id='next'class="btn btn-success" disabled>Next</a>
            </div>
        </div>
    </form>


</div>

<script>
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
                $.ajax({
                    type: "POST",
                    url: "{{ route('capture') }}",
                    data: {
                        '_token': '<?php echo csrf_token(); ?>',
                        'image' : photo
                    },
                    success: function(data) {
                        if(data.msg = "Berhasil"){
                            // alert('yey berhasil')
                            $('#next').prop("disabled", false)
                        }
                        else
                        {
                            $('#next').prop("disabled", true)
                        }
                    }
                });

            else{
                alert('foto sudah terkumpul');
            }

        } );
    }
</script>

@endsection
