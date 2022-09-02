@extends('layouts.adminlte')

@section('title')
Assign Tugas
@endsection

@section('page-bar')
@endsection

@section('contents')


@if(Auth::user()->role->nama_role == 'adminblk')
<div class="col-sm-6">
    <h2 class="m-0 text-dark">Penugasan Admin</h2><br> {{--PER SESI --}}
</div>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card-tugas">
            <div class="portlet-body form">

                <form role='form' method="POST" enctype="multipart/form-data" action="">
                    @csrf
                    <div class="form-body">

                        <div class="form-group">
                            <label for="nama" class="col-md-12 col-form-label">{{ __('Nama Admin') }}</label>

                            <div class="col-md-12">
                                <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" required autocomplete="nama" autofocus>

                                @error('nama')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="namaVerifikator" class="col-md-12 col-form-label">{{ __('Nama Verifikator') }}</label>

                            <div class="col-md-12">
                                <input id="namaVerifikator" type="text" class="form-control @error('namaVerifikator') is-invalid @enderror" name="namaVerifikator" required autocomplete="namaVerifikator" autofocus>

                                @error('namaVerifikator')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="keterangan" class="col-md-12 col-form-label">{{ __('Keterangan') }}</label>
                            <div class="col-md-12">
                                <input id="keterangan" type="text" class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" required autocomplete="keterangan" autofocus>

                                @error('keterangan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="buktiKonfirmasi" class="col-md-12 col-form-label">{{ __('Bukti Konfirmasi') }}</label>

                            <input type="file" name='buktiKonfirmasi' class="defaults" value="" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">SIMPAN</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection