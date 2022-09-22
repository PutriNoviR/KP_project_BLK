@extends('layouts.adminlte')

@section('style')
<style>
    #upload-photo {
        opacity: 0;
        position: absolute;
        z-index: -1;
    }

    img#profil-foto {}

    .preview {
        overflow: hidden;
        width: 160px;
        height: 160px;
        margin: 10px;
        border: 1px solid red;
    }

</style>
@endsection

@section('javascript')
<script>
    $(function () {
        ClassicEditor
            .create(document.querySelector('#tentang_perusahaan'))
            .catch(error => {
                console.error(error);
            });

        $('#btnubahdata').click(function () {
            $('#btnubahdata').hide();
            $('#data-perusahaan').hide();
            $('#ubah-data-perusahaan').removeClass('d-none');
        });

        $('#btnbatal').click(function () {
            $('#btnubahdata').show();
            $('#data-perusahaan').show();
            $('#ubah-data-perusahaan').addClass('d-none');
        })

    });

    var bs_modal = $('#profilModal');
    var image = document.getElementById('profil-foto');
    var cropper, reader, file;


    $("body").on("change", ".image", function (e) {
        var files = e.target.files;
        var done = function (url) {
            image.src = url;
        };


        if (files && files.length > 0) {
            file = files[0];

            if (URL) {
                done(URL.createObjectURL(file));
            } else if (FileReader) {
                reader = new FileReader();
                reader.onload = function (e) {
                    done(reader.result);
                };
                reader.readAsDataURL(file);
            }
        }
        $('#upload-photo-container').addClass('d-none');
        $('#btnsimpanfoto').removeClass('disabled');
        $('#img-container').removeClass('d-none');

        cropper = new Cropper(image, {
            aspectRatio: 1,
            viewMode: 2,
            preview: '.preview'
        });
    }).on('hidden.bs.modal', function () {
        $('#upload-photo-container').removeClass('d-none');
        $('#btnsimpanfoto').addClass('disabled');
        $('#img-container').addClass('d-none');
        cropper.destroy();
        cropper = null;
    });

    $("#btnsimpanfoto").click(function () {
        canvas = cropper.getCroppedCanvas({
            width: 160,
            height: 160,
        });

        canvas.toBlob(function (blob) {
            url = URL.createObjectURL(blob);
            var reader = new FileReader();
            reader.readAsDataURL(blob);
            reader.onloadend = function () {
                var base64data = reader.result;

                $.ajax({
                    type: "POST",
                    url: "{{ route('perusahaan.editfoto') }}",
                    data: {
                        image: base64data,
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function (data) {
                        location.reload();
                    }
                });
            };
        });
    });

</script>

@endsection

@section('contents')
<section class="content">
    <div class="container-fluid">
        <div class="card p-5">
            <div class="d-flex">
                <div class="position-relative">
                    <img src="{{ asset('storage/'.$perusahaan->logo) }}" class="rounded-circle" width="100" height="100"
                        alt="">
                    <button data-toggle="modal" data-target="#profilModal"
                        class="btn btn-primary btn-sm rounded-circle position-absolute" style="right: 0;bottom:0">
                        <i class="fas fa-pen"></i>
                    </button>
                </div>
                <div class="ml-5 d-flex justify-content-between w-100">
                    <div class="">
                        <h3 class="font-weight-normal">{{ $perusahaan->nama }}</h3>
                        <span class="text-muted d-block">Nomor Telepon : {{ $perusahaan->no_telp }}</span>
                        <span class="text-muted">Email : {{ $perusahaan->email }}</span>
                    </div>
                    <div>
                        <button class="btn btn-outline-primary rounded font-weight-bold" id="btnubahdata">Ubah
                            Data</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card p-4" id="data-perusahaan">
            <h3 class="mb-4 font-weight-bold">Data Perusahaan</h3>
            <div class="row">
                <div class="col-4">
                    <p>
                        <span class="text-muted d-block">Nama Perusahaan</span>
                        <span>{{ $perusahaan->nama }}</span>
                    </p>
                    <p>
                        <span class="text-muted d-block">Email Perusahaan</span>
                        <span>{{ $perusahaan->email }}</span>
                    </p>
                </div>
                <div class="col-4">
                    <p>
                        <span class="text-muted d-block">Nomor Telepon</span>
                        <span>{{ $perusahaan->no_telp }}</span>
                    </p>
                    <p>
                        <span class="text-muted d-block">Alamat</span>
                        <span>{{ $perusahaan->alamat }}</span>
                    </p>
                </div>
                <div class="col-4">
                    <p>
                        <span class="text-muted d-block">Bidang</span>
                        <span>{{ $perusahaan->bidang }}</span>
                    </p>
                    <p>
                        <span class="text-muted d-block">Kode Pos</span>
                        <span>{{ $perusahaan->kode_pos }}</span>
                    </p>
                </div>

            </div>
            <hr>
            <h3 class="font-weight-bold">Tentang Perusahaan</h3>
            <p>{!! $perusahaan->tentang_perusahaan !!}</p>
        </div>
        <form class="card p-4 d-none" id="ubah-data-perusahaan"
            action="{{ route('perusahaan.update',$perusahaan->id) }}" method="POST">
            @csrf
            @method('PUT')
            <h3 class="mb-4 font-weight-bold">Data Perusahaan</h3>
            <div class="row">
                <div class="col-4">
                    <p>
                        <span class="text-muted d-block">Nama Perusahaan</span>
                        <input type="text" class="form-control" name="nama_perusahaan" id="nama-perusahaan"
                            value="{{ $perusahaan->nama }}">
                    </p>
                    <p>
                        <span class="text-muted d-block">Email Perusahaan</span>
                        <input type="text" class="form-control" disabled id="email-perusahaan"
                            value="{{ $perusahaan->email }}">
                    </p>
                </div>
                <div class="col-4">
                    <p>
                        <span class="text-muted d-block">Nomor Telepon</span>
                        <input type="text" class="form-control" disabled id="notelp-perusahaan"
                            value="{{ $perusahaan->no_telp }}">
                    </p>
                    <p>
                        <span class="text-muted d-block">Alamat</span>
                        <textarea class="form-control" name="alamat_perusahaan" id="alamat-perusahaan"
                            rows="2">{{ $perusahaan->alamat }}</textarea>
                    </p>
                </div>
                <div class="col-4">
                    <p>
                        <span class="text-muted d-block">Bidang</span>
                        <input type="text" class="form-control" name="bidang_perusahaan" id="bidang-perusahaan"
                            value="{{ $perusahaan->bidang }}">
                    </p>
                    <p>
                        <span class="text-muted d-block">Kode Pos</span>
                        <input type="text" class="form-control" name="kodepos_perusahaan" id="kodepos-perusahaan"
                            value="{{ $perusahaan->kode_pos }}">
                    </p>
                </div>

            </div>
            <hr>
            <h3 class="font-weight-bold">Tentang Perusahaan</h3>
            <textarea name="tentang_perusahaan"
                id="tentang_perusahaan">{!! $perusahaan->tentang_perusahaan !!}</textarea>
            <hr>
            <div class="text-right">
                <button id="btnbatal" class="btn btn-outline-primary mr-2 font-weight-bold">Batal</button>
                <button type="submit" id="btnbatal" class="btn btn-primary rounded font-weight-bold">Simpan</button>
            </div>
        </form>
    </div>
</section>
{{-- Modal Foto Profil --}}
<div class="modal fade" id="profilModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ganti Foto Profil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="upload-photo-container">
                    <p>Foto</p>
                    <label for="upload-photo" class="custom-file-upload btn btn-primary rounded font-weight-bold"><i
                            class="fas fa-upload"></i>
                        Pilih Foto</label>
                    <input type="file" id="upload-photo" name="upload-photo" class="image">
                </div>
                <div id="img-container" class="d-none">
                    <div class="row">
                        <div class="col-md-8">
                            <img id="profil-foto">
                        </div>
                        <div class="col-md-4">
                            <div class="preview rounded-circle"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary mr-2 font-weight-bold"
                    data-dismiss="modal">Tutup</button>
                <button type="button" id="btnsimpanfoto"
                    class="btn btn-primary rounded font-weight-bold disabled">Simpan</button>
            </div>
        </div>
    </div>
</div>
@endsection
