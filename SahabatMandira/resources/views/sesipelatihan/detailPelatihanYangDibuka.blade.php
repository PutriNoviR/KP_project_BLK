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
</script>
@endsection

@section('contents')
@if($sesi == '0')
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
                <td>{{ $d->aktivitas }}</td>
                <td>
                    <a href="{{url('sesiPelatihan/'.$d->id)}}" class="button btn btn-warning">{{ __('DAFTAR') }}</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@elseif($sesi == '1')
<div class="container">
    <div class="d-flex justify-content-between mb-2">
        <h2>Daftar Pelatihan Terbaik</h2>
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
                <th class="center">No</th>
                <th class="text-center">Perusahaan</th>
                <th class="text-center">Periode Pendaftaran</th>
                <th class="text-center">Deskripsi</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody id="myTable">
            @foreach($data as $d)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $d->nama }}</td>
                <td>{{ date('d-M-y', strtotime($d->tanggal_buka)) }} -
                    {{ date('d-M-y', strtotime($d->tanggal_tutup)) }}
                </td>
                <td>{{ $d->deskripsi }}</td>
                <td>
                    <a href="{{url('sesiPelatihan/'.$d->id)}}" class="button btn btn-warning">{{ __('DAFTAR') }}</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@elseif($sesi == '2')
<div class="container">
    <div class="d-flex justify-content-between mb-2">
        <h2>Daftar Program Mentor</h2>
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
                <th>NO</th>
                <th>Nama Program</th>
                <th>Deskripsi</th>
                <th>Periode</th>
                <th>Link Pendaftaran</th>
                <th>Mentor</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $m)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $m->nama_program}}</td>
                <td>{{ $m->deskripsi_program}}</td>
                <td>{{ $m->tgl_dibuka}} - {{ $m->tgl_ditutup}}</td>
                <td>{{ $m->link_pendaftaran}}</td>
                <td>{{ $m->nama_depan}} {{ $m->nama_belakang}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif
@endsection