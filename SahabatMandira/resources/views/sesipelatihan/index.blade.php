@extends('layouts.adminlte')

@section('title')
PAKET PROGRAM
@endsection

@section('page-bar')
<ul class="page-breadcrumb">
    <li>
        <i class="fa fa-home"></i>
        <a href="http://127.0.0.1:8000/">Dashboard</a>
        <i class="fa fa-angle-right"></i>
    </li>

    <li>
        <a href="http://127.0.0.1:8000/menu/kejuruan">SESI PELATIHAN</a>
        <i class="fa fa-angle-right"></i>
    </li>
</ul>
@endsection

@section('contents')
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
                <th>Nama Balai Latihan Kerja</th>
                <th>Kejuruan</th>
                <th>Sub Kejuruan</th>
                <th>Tanggal Buka Pendaftaran</th>
                <th>Tanggal Tutup Pendaftaran</th>
                <th>Lokasi</th>
                <th>Kuota</th>
                <th>Tanggal Seleksi</th>
                <th>Aktivitas</th>

                <th>Aksi</th>
            </tr>
        </thead>
        <tbody id="myTable">
            {{-- @foreach($data as $d)
            <tr>
                <td>{{ $loop->iteration }}</td>
            <td>{{ $d->blks->nama }}</td>
            <td>{{ $d->kejuruan->nama }}</td>
            <td>{{ $d->sub_kejuruans->nama }}</td>
            <td>
                <a data-toggle="modal" data-target="#modalEditBlk" class='btn btn-warning' onclick="modalEdit({{$d->id}})">
                    <i class="fas fa-pen"></i>
                </a>
                <form method="POST" action="{{ route('blk.destroy',$d->id) }}" onsubmit="return submitFormDelete(this);" class="d-inline">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger" data-toggle="modal" href="{{route('blk.show',$d->id)}}" data-toggle="modal"><i class="fas fa-trash"></i></button>
                </form>
            </td>
            </tr>
            @endforeach --}}
        </tbody>
    </table>
</div>