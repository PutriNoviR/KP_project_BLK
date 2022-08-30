@extends('layouts.adminlte')

@section('title')
Dashboard
@endsection

@section('page-bar')
<div class="col-sm-6">
    <h1 class="m-0 text-dark">Dashboard</h1>
</div><!-- /.col -->
@endsection

@section('contents')

@if(Auth::user()->role->nama_role == 'peserta')
<div></div>
<div class="col-sm-6">
    <h4 class="m-0 text-dark">PROGRAM PELATIHAN</h4><br>
    <h6>Berikut adalah program pelatihan yang disarankan untuk diikuti</h6>
</div>
<div class="col-sm-3">
    @foreach($disarankan as $d)
    @if($d != null)
    <div class="card card-primary">
        <div class="ribbon-wrapper">
            <div class="ribbon bg-primary">
                {{ $d->paketprogram->blk->nama }}
            </div>
        </div>
        <div class="card-header">
            <h3 class="card-title">{{ $d->paketprogram->kejuruan->nama }}</h3>
        </div>
        <div class="card-body">
            <!-- <h1>GAMBAR KEJURUAN</h1>{{-- ganti pake gambar ada di dalam sesi_pelatihans --}} -->
            <img src="{{ asset('images/programPelatihan/'.$d->gambar_pelatihan.'') }}"
                style='width:50%; height:50%; padding: 10px' alt="gambar kejuruan">
        </div>
        <div class="card-body">
            {{ $d->paketprogram->subkejuruan->nama }}
        </div>
        <div class="card-body">
            <p>{{\Illuminate\Support\Str::limit($d->deskripsi,20,'...')}}.</p> {{--ini belum ambil dari db--}}
        </div>
        <div class="card-footer">
            <a href="{{url('sesiPelatihan/'.$d->id)}}" class="button btn btn-primary">{{ __('DETAIL') }}</a>
        </div>
    </div>
    @endif
    @endforeach
</div>

<br>

<div class="">
    <div class="col-sm-6">
        <h4 class="m-0 text-dark">PROGRAM PELATIHAN YANG DITAWARKAN</h4><br>
        <h6>Berikut adalah program pelatihan yang ditawarkan</h6>
    </div>

    <div class="row ">

        @foreach($ditawarkan as $d)
        <div class="col-sm-3 ">
            <div class="card card-primary ">
                <div class="ribbon-wrapper">
                    <div class="ribbon bg-primary">
                        {{ $d->paketprogram->blk->nama }}
                    </div>
                </div>
                <div class="card-header">
                    <h3 class="card-title">{{ $d->paketprogram->kejuruan->nama }}</h3>
                </div>
                <div class="card-body">
                    <!-- <h1>GAMBAR KEJURUAN</h1> -->
                    <img src="{{ asset('images/programPelatihan/'.$d->gambar_pelatihan.'') }}"
                        style='width:50%; height:50%; padding: 10px' alt="gambar kejuruan">
                </div>
                <div class="card-body">
                    {{ $d->paketprogram->subkejuruan->nama }}
                </div>
                <div class="card-body">
                    <p>{{\Illuminate\Support\Str::limit($d->deskripsi,20,'...')}}.</p>
                </div>
                <div class="card-footer">
                    <a href="{{url('sesiPelatihan/'.$d->id)}}" class="button btn btn-primary">{{ __('DETAIL') }}</a>
                </div>
            </div>
        </div>

        @endforeach
    </div>
</div>

@endif

@if(Auth::user()->role->nama_role == 'adminblk')

<div class="container">
    <div class="d-flex justify-content-between mb-2">
        <h2>Sesi Pelatihan Yang Dibuka dari BLK </h2>
    </div>
    @if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
    @endif
    <table class="table table-striped table-bordered table-hover dataTable no-footer" id="myTable" role="grid"
        aria-describedby="sample_1_info">
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
            @foreach($adminDashboard as $d)
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
                    <a data-toggle="modal" data-target="#modalTambahInstruktur{{$d->id}}" class='btn btn-warning'>
                        Tambah Instruktur
                    </a>
                    <a data-toggle="modal" data-target="" class='btn btn-warning' onclick="modalEdit({{$d->id}})">
                        <i class="fas fa-pen"></i>
                    </a>
                    <form method="POST" action="" onsubmit="return submitFormDelete(this);" class="d-inline">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger" data-toggle="modal" href="" data-toggle="modal"><i
                                class="fas fa-trash"></i>
                        </button>
                    </form>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


{{-- Modal tambah Instruktur --}}
@foreach($adminDashboard as $d)
<div class="modal fade" id="modalTambahInstruktur{{$d->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
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
                            <input type="hidden" name="sesi_pelatihans_id" class="col-md-12 col-form-label"
                                value="{{$d->id}}">
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

@can('adminperusahaan-permission')

@endcan

@endsection
