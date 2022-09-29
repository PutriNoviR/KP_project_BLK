@extends('layouts.adminlte')

@section('title')
PELATIHAN
@endsection

@section('page-bar')

@endsection

@section('javascript')
<script>
    $(function() {
        $("#myTable").DataTable({
            "responsive": true,
            "autoWidth": false,
        });
    });

    function modalEdit(sesiPelatihanId) {
        $.ajax({
            type: 'POST',
            url: '{{ route("sesiPelatihan.getEditForm") }}',
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'id': sesiPelatihanId,
            },
            success: function(data) {
                $("#modalContent").html(data.msg);
            },
            error: function(xhr) {
                console.log(xhr);
            }
        });
    }

    function notification(form) {
        swal({
                title: "Success!",
                text: "Sudah Daftar Ulang",
                icon: "success",
                buttons: "Oke",
            })
            .then((willDelete) => {
                if (willDelete) {
                    form.submit();
                }
            });
        return false;
    }

    function submitFormDelete(form) {
        swal({
                title: "Peringatan!",
                text: "Apakah anda yakin ingin menghapus data ini?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    form.submit();
                }
            });
        return false;
    }

    function alertShowPeserta(id) {
        $.ajax({
            type: 'POST',
            url: '{{ route("sesiPelatihan.getDetailPeserta") }}',
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'id': id,
            },
            success: function(data) {
                swal({
                    title: "Data Peserta",
                    text: data.data,
                })
            },
            error: function(xhr) {
                console.log(xhr);
            }
        });
    }

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
{{--SISI PESERTA --}}

@if(Auth::user()->role->nama_role == 'peserta')

<div class="container">
    <div class="d-flex justify-content-between mb-2">
        <h2>Riwayat Pelatihan</h2>
    </div>
    @if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
    @endif
    <table class="table table-striped table-bordered table-hover dataTable no-footer" id="myTable" role="grid" aria-describedby="sample_1_info">
        <thead>
            <tr role="row">
                <th>No</th>
                <th>Nama Balai Latihan Kerja</th>
                <th>Kejuruan</th>
                <th>Sub Kejuruan</th>
                <th>Periode</th>
                <th>Status</th>
                <th>Daftar</th>
                <th>Sertifikat</th>
            </tr>
        </thead>
        <tbody id="myTable">
            @foreach($dataPeserta as $d)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $d->paketprogram->blk->nama }}</td>
                <td>{{ $d->paketprogram->kejuruan->nama }}</td>
                <td>{{ $d->paketprogram->subkejuruan->nama }}</td>
                <td>{{ date('d-M-y', strtotime($d->tanggal_pendaftaran)) }} -
                    {{ date('d-M-y', strtotime($d->tanggal_tutup)) }}
                </td>
                <td>{{ $d->status_fase}}</td> {{-- lulus / tidak lulus--}}
                <td>
                    <form method="POST" action="{{ route('sesiPelatihan.daftarulang') }}" class="d-inline">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" name="sesi_pelatihans_id" class="col-md-12 col-form-label" value="{{$d->sesi_pelatihans_id}}">
                            @if($d->status_fase  == 'DITERIMA')
                            <button data-toggle="modal" data-target="" class='btn btn-success' {{ $d->is_daftar_ulang  == '1' ? 'disabled' : ''}}>
                                Daftar Ulang
                            </button> {{-- kalau lolos di enable kalo ga lolos disable--}}
                            @else
                            <button data-toggle="modal" data-target="" class='btn btn-danger' disabled {{ $d->is_daftar_ulang  == '1' ? 'disabled' : ''}}>
                                Daftar Ulang
                            </button> {{-- kalau lolos di enable kalo ga lolos disable--}}
                            @endif
                        </div>
                    </form>
                </td>
                <td>
                    <button data-toggle="modal" data-target="" class='btn btn-warning' disabled>
                        Download Sertifikat
                    </button> {{-- kalau lolos di enable kalo ga lolos disable--}}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif

{{--SISI VERIFIKATOR --}}

@if(Auth::user()->role->nama_role == 'verifikator')
<div class="container">
    <div class="d-flex justify-content-between mb-2">
        <h2>Daftar Sesi Pelatihan</h2>
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
                        <i class="fas fa-eye"></i>
                    </button></td>
                <td>
                    <!-- <a data-toggle="modal" data-target="#modalDetailPeserta{{$d->id}}" class='btn btn-info' value>
                        <i class="fas fa-eye"></i>
                    </a> -->
                    <a href="{{ url('pelatihanPesertas/'.$d->id) }}" class="button btn btn-primary">
                        <i class="fas fa-eye"></i> {{--PINDAHIN KE UI  --}}
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif


{{--SISI SUPER ADMIN--}}

@if(Auth::user()->role->nama_role == 'superadmin' || Auth::user()->role->nama_role == 'adminblk')
<div class="container">
    <div class="d-flex justify-content-between mb-2">
        <h2>Daftar Sesi Pelatihan</h2>
    </div>
    @if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
    @endif
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
            @foreach($data as $d)
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
                        <i class="fas fa-eye"></i>
                    </button></td>
                <td>
                    <a data-toggle="modal" data-target="#modalTambahInstruktur{{$d->id}}" class='btn btn-warning'>
                        Tambah Instruktur
                    </a>
                    <a data-toggle="modal" data-target="#modalEditSesiPelatihan" class='btn btn-warning' onclick="modalEdit({{$d->id}})">
                        <i class="fas fa-pen"></i>
                    </a>
                    <form method="POST" action="{{ route('sesiPelatihan.destroy',$d->id) }}" onsubmit="return submitFormDelete(this);" class="d-inline">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger" data-toggle="modal" href="" data-toggle="modal"><i class="fas fa-trash"></i>
                        </button>
                    </form>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{-- BUAT PANGGIL MODAL YANG ADA DI MODAL.BLADE --}}
<!-- Modal -->
<div class="modal fade" id="modalEditSesiPelatihan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" id="modalContent">

    </div>
</div>

{{-- Modal tambah Instruktur --}}
@foreach($data as $d)
<div class="modal fade" id="modalTambahInstruktur{{$d->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Email Instruktur</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body">
                <div class="card-body">
                    <form method="POST" action="{{ route('pelatihanMentors.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="nama" class="col-md-12 col-form-label">{{ __('Nama Instruktur') }}</label>
                            <div class="col-md-12">
                                <select class="form-control" aria-label="Default select example" name="mentors_email">
                                    <option selected>Nama Instruktur</option>
                                    @foreach($user as $us)
                                    <option value="{{$us->email}}">{{$us->username}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="hidden" name="sesi_pelatihans_id" class="col-md-12 col-form-label" value="{{$d->id}}">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
@endif
@endsection