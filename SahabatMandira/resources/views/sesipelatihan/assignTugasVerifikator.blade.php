@extends('layouts.adminlte')

@section('title')
Assign Tugas
@endsection

@section('page-bar')
@endsection

@section('contents')


@if(Auth::user()->role->nama_role == 'adminblk')


{{-- MODAL UNTUK PENUGASAN ADMIN --}}
<div class="modal fade" id="modalPenugasanAdmin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" id="modalContent">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Penugasan Admin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
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