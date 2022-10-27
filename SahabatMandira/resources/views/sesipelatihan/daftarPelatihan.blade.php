@extends('layouts.adminlte')

@section('title')
PELATIHAN
@endsection

@section('javascript')
<script>
    $(function() {
        $("#myTable").DataTable({
            "responsive": true,
            "autoWidth": false,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
    });

    function alertShow(id) {
        $.ajax({
            type: 'POST',
            url: '{{ route("sesiPelatihan.getDetail") }}',
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'id': id,
            },
            success: function (data) {
                swal({
                    title: "Aktivitas",
                    text: data.data,
                })
            },
            error: function (xhr) {
                console.log(xhr);
            }
        });
    }
</script>
@endsection


@section('contents')
<div class="container">
    <div class="d-flex justify-content-between mb-2">
        <h2>Penugasan Admin</h2>
    </div>
    <table class="table table-striped table-bordered table-hover dataTable no-footer" id="myTable" role="grid" aria-describedby="sample_1_info">
        <thead>
            <tr role="row">
                <th>No</th>
                <th>BLK</th>
                <th>Kejuruan</th>
                <th>Sub Kejuruan</th>
                <th>Periode Pendaftaran</th>
                <th>Lokasi</th>
                <th>Kuota</th>
                <th>Tanggal Seleksi</th>
                <th>Aktivitas</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody id="myTable">
            @foreach($dataInstruktur as $d)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $d->paketprogram->blk->nama }}</td>
                <td>{{ $d->paketprogram->kejuruan->nama }}</td>
                <td>{{ $d->paketprogram->subkejuruan->nama }}</td>
                <td>{{ date('d-M-y', strtotime($d->tanggal_pendaftaran)) }} -
                    {{ date('d-M-y', strtotime($d->tanggal_tutup)) }}
                </td>
                <td>{{ $d->lokasi }}</td>
                <td>{{ $d->kuota }}</td>
                <td>{{ $d->tanggal_seleksi }}</td>
                <td><button class='btn btn-info' onclick="alertShow({{$d->id}})">
                        <i class="fas fa-eye"></i></td>
                <td>
                    @if(Auth::user()->role->nama_role == 'superadmin' || Auth::user()->role->nama_role == 'adminblk')
                    <div class="margin-bottom-15">
                        <a data-toggle="modal" data-target="#modalPenugasanAdmin{{$d->id}}" class="button btn btn-primary">
                            <i class="fas fa-plus">Tambah Penugasan</i>
                        </a>
                    </div>
                    <div>
                        <a href="{{ route('tugas.show',$d->id) }}" class="button btn btn-warning">
                            <i class="fas fa-eye">Lihat Riwayat</i>
                        </a>
                    </div>
                    @else
                    <a href="{{ url('pelatihanPesertas/'.$d->id) }}" class="button btn btn-primary">
                        <i class="fas fa-eye"></i> {{--PINDAHIN KE UI  --}}
                    </a>
                    @endif

                </td>
            </tr>
            {{-- MODAL UNTUK PENUGASAN ADMIN --}}
            <div class="modal fade" id="modalPenugasanAdmin{{$d->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" id="modalContent">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Penugasan Admin</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form role='form' method="POST" enctype="multipart/form-data" action="{{ route('tugas.store') }}">
                                @csrf
                                <div class="form-body">

                                    <div class="form-group">
                                        <label for="nama" class="col-md-12 col-form-label">{{ __('Email Admin') }}</label>
                                        <input type="hidden" name="id" class="col-md-12 col-form-label" value="{{$d->id}}">
                                        <div class="col-md-12">
                                            <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror" name="email_admin" value="{{$userLogin}}" readonly autocomplete="nama" autofocus>

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
                                            <select class="form-control" aria-label="Default select example" name="email_mentor">
                                                @foreach($mentor as $d)
                                                <option value="{{$d->email}}">
                                                    {{$d->nama_depan}} {{$d->nama_belakang}}
                                                </option>
                                                {{-- untuk melakukan pengecekan seperti if apakah id blk yang ada di paket program sama dengan id blk yang ada di foreach ?--}}
                                                @endforeach
                                            </select>
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

                                        <input type="file" name='bukti' class="defaults" value="" required>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary" >SIMPAN</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </tbody>
    </table>
</div>


@endsection