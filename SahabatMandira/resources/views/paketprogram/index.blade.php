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
        <a href="http://127.0.0.1:8000/menu/kejuruan">PAKET PROGRAM</a>
        <i class="fa fa-angle-right"></i>
    </li>
</ul> --}}
@endsection

@section('contents')
<div class="container">
    <div class="d-flex justify-content-between mb-2">
        <h2>Daftar Paket Program</h2>
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">
            Tambah Paket Program Baru
        </button>
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
                Tambah Sesi Pelatihan
            </a>
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
        @endforeach

        
        <!--
            dummy data
             <tr>
                {{-- <td>{{ $loop->iteration }}</td> --}}
        <td>nama blk</td>
        <td>nama kejuruan</td>
        <td>nama sub kejuruan</td>
        <td>
            <a data-toggle="modal" data-target="#modalTambahSesi" class='btn btn-warning' onclick="modalEdit({{$d->id}})">
                Tambah Sesi Pelatihan
            </a>
            <a data-toggle="modal" data-target="#modalEditBlk" class='btn btn-warning' onclick="modalEdit({{$d->id}})">
                <i class="fas fa-pen"></i>
            </a>
            <form method="POST" action="{{ route('blk.destroy',$d->id) }}" onsubmit="return submitFormDelete(this);" class="d-inline">
                @method('DELETE')
                @csrf
                <button type="submit" class="btn btn-danger" data-toggle="modal" href="{{route('blk.show',$d->id)}}" data-toggle="modal"><i class="fas fa-trash"></i></button>
            </form>
        </td>
        </tr> -->
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="modalEditBlk" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" id="modalContent">

    </div>
</div>

<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Paket Program</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <form method="POST" action="{{ route('blk.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="nama" class="col-md-12 col-form-label">{{ __('Nama Balai Latihan Kerja') }}</label>

                            {{-- <div class="col-md-12">
                                <input id="nama" type="nama" class="form-control @error('email') is-invalid @enderror" name="nama" value="{{ old('nama') }}" required autocomplete="nama" autofocus>

                            @error('nama')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div> --}}

                        <div class="col-md-12">

                            <select class="form-control" aria-label="Default select example" name="name">
                                <option value="1">BLK satu</option>
                                <option value="0">BLK dua</option>
                            </select>

                            @error('website')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                </div>

                <div class="form-group">
                    <label for="kejuruan" class="col-md-12 col-form-label">{{ __('Kejuruan') }}</label>

                    {{-- <div class="col-md-12">
                                <input id="kejuruan" type="text" class="form-control @error('alamat') is-invalid @enderror" name="kejuruan" value="{{ old('kejuruan') }}" required autocomplete="kejuruan" autofocus>

                    @error('kejuruan')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div> --}}

                <div class="col-md-12">

                    <select class="form-control" aria-label="Default select example" name="kejuruan">
                        <option value="1">kejuruan satu</option>
                        <option value="0">kejuruan dua</option>
                    </select>

                    @error('website')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="subKejuruan" class="col-md-12 col-form-label">{{ __('Sub Kejuruan') }}</label>

                <div class="col-md-12">

                    <select class="form-control" aria-label="Default select example" name="subKejuruan">
                        <option value="1">Sub kejuruan satu</option>
                        <option value="0">Sub kejuruan dua</option>
                    </select>

                    @error('website')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">SIMPAN</button>
            </div>
            </form>
        </div>
    </div>
</div>


 {{-- MODAL UNTUK TAMBAH SESI PELATIHAN--}}
<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Sesi Pelatihan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <form method="POST" action="{{ route('blk.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="nama" class="col-md-12 col-form-label">{{ __('Tanggal Buka Pendaftaran') }}</label>
                            <input type="datetime-local" class="col-md-12 col-form-label">

                        <div class="col-md-12">

                            @error('website')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('blk.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="nama" class="col-md-12 col-form-label">{{ __('Tanggal Tutup Pendaftaran') }}</label>
                            <input type="datetime-local" class="col-md-12 col-form-label">

                        <div class="col-md-12">

                            @error('website')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                </div>
            </div>

            <div class="form-group">
                <label for="subKejuruan" class="col-md-12 col-form-label">{{ __('Lokasi') }}</label>
                <input type="text" class="col-md-12 col-form-label"
            </div>
            <div class="form-group">
                <label for="subKejuruan" class="col-md-12 col-form-label">{{ __('Kuota') }}</label>
                <input type="text" class="col-md-12 col-form-label"
            </div>

            <div class="card-body">
                    <form method="POST" action="{{ route('blk.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="nama" class="col-md-12 col-form-label">{{ __('Tanggal Seleksi') }}</label>
                            <input type="datetime-local" class="col-md-12 col-form-label">

                        <div class="col-md-12">

                            @error('website')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">SIMPAN</button>
            </div>
            </form>
        </div>
    </div>
</div>

@endsection