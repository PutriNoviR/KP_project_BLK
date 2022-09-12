@extends('layouts.adminlte')

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

</script>
@endsection

@section('contents')
<section class="content">
    <div class="container-fluid">
        <div class="card p-5">
            <div class="d-flex">
                <img src="{{ asset('storage/'.$perusahaan->logo) }}" class="rounded-circle d-block" width="100"
                    height="100" alt="">
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
@endsection
