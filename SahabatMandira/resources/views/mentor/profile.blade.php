@extends('layouts.adminlte')

@section('title')
Profile
@endsection

@section('contents')
<section class="content">
    <div class="container-fluid">
        <div class="card p-5">
            <div class="d-flex">
                <img src="{{ asset('storage/'.$user->pas_foto) }}" class="rounded-circle d-block" width="100" height="100" alt="">
                <div class="ml-5 d-flex justify-content-between w-100">
                    <div class="">
                        <h3 class="font-weight-normal">{{ $user->nama_depan }} {{ $user->nama_belakang }}</h3>
                        <span class="text-muted d-block">Nomor Telepon : {{ $user->nomer_hp }}</span>
                        <span class="text-muted">Email : {{ $user->email }}</span>
                    </div>
                    <div>
                        <button class="btn btn-outline-primary rounded font-weight-bold" id="btnubahdata">Ubah
                            Data</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card p-4" id="data-perusahaan">
            <h3 class="mb-4 font-weight-bold">Data Mentor</h3>
            <div class="row">
                <div class="col-4">
                    <p>
                        <span class="text-muted d-block">Nama Mentor</span>
                        <span>{{ $user->nama_depan }} {{ $user->nama_belakang }}</span>
                    </p>
                    <p>
                        <span class="text-muted d-block">Email Mentor</span>
                        <span>{{ $user->email }}</span>
                    </p>
                </div>
                <div class="col-4">
                    <p>
                        <span class="text-muted d-block">Nomor Telepon</span>
                        <span>{{ $user->nomer_hp }}</span>
                    </p>
                    <p>
                        <span class="text-muted d-block">Alamat</span>
                        <span>{{ $user->alamat }}</span>
                    </p>
                </div>

            </div>
            <hr>
        </div>
        <form class="card p-4 d-none" id="ubahDataMentor" action="" method="POST">
            @csrf
            @method('PUT')
            <h3 class="mb-4 font-weight-bold">Data Mentor</h3>
            <div class="row">
                <div class="col-4">
                    <p>
                        <span class="text-muted d-block">Nama Mentor</span>
                        <input type="text" class="form-control" name="nama_perusahaan" id="nama-perusahaan" value="">
                    </p>
                    <p>
                        <span class="text-muted d-block">Email Mentor</span>
                        <input type="text" class="form-control" disabled id="email-perusahaan" value="">
                    </p>
                </div>
                <div class="col-4">
                    <p>
                        <span class="text-muted d-block">Nomor Telepon</span>
                        <input type="text" class="form-control" disabled id="notelp-perusahaan" value="">
                    </p>
                    <p>
                        <span class="text-muted d-block">Alamat</span>
                        <textarea class="form-control" name="alamat_perusahaan" id="alamat-perusahaan" rows="2"></textarea>
                    </p>
                </div>
                <div class="col-4">
                    <p>
                        <span class="text-muted d-block">Bidang Keahlian</span>
                        <span></span>
                    </p>
                </div>

            </div>
            <hr>
            <div class="text-right">
                <button id="btnbatal" class="btn btn-outline-primary mr-2 font-weight-bold">Batal</button>
                <button type="submit" id="btnbatal" class="btn btn-primary rounded font-weight-bold">Simpan</button>
            </div>
        </form>
    </div>
</section>
@endsection