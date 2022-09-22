@extends('layouts.adminlte')

@section('title')
Dashboard
@endsection

@section('javascript')
<script>
    $(function() {
        $("#myTable").DataTable({
            "responsive": true,
            "autoWidth": false,
        });
    });

    function modalEdit(id_mentoring) {
        $.ajax({
            type: 'POST',
            url: '{{ route("mandiraMentoring.getEditForm") }}',
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'id_mentoring': id_mentoring,
            },
            success: function(data) {
                $("#modalContent").html(data.msg);
            },
            error: function(xhr) {
                console.log(xhr);
            }
        });
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
</script>
@endsection


@section('page-bar')
<div class="col-sm-6">
    <h1 class="m-0 text-dark">Dashboard</h1>
</div><!-- /.col -->
@endsection

@section('contents')

@if($suspend == 0)

@if(Auth::user()->role->nama_role == 'peserta')

{{-- mengecek di db apakah peminatan udah terisi atau blm ? kalau sudah hitang, kalau blm ada. --}}
@if(count($disarankan) === 0)
<div class="alert alert-warning" role="alert">
    <center>Anda belum mengikuti tes kejuruan, Ikuti tes untuk mengetahui pelatihan yang sesuai dengan minat kejuruan anda ! &nbsp;&nbsp;&nbsp;
        <a href="https://ubayavii.id" class="button btn btn-primary" target="_blank">IKUTI TES SEKARANG !</a>
    </center>
</div>
@else
<div class="container">
    <div class="col-sm-6">
        <h4 class="m-0 text-dark">PROGRAM PELATIHAN</h4><br>
        <h6>Berikut adalah program pelatihan yang disarankan untuk diikuti</h6>
    </div>

    <div class="row ">
        @foreach($disarankan as $d)
        <div class="col-sm-3">
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
                    <img src="{{ asset('storage/'.$d->gambar_pelatihan.'') }}" style='width:100%; height:100%; padding: 10px' alt="gambar kejuruan">
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
        </div>
        @endforeach
    </div>
</div>
@endif
<hr>

<br>

<div class="container">
    <a href="{{ url('sesiPelatihan/showMore/1') }}" class="button btn btn-outline-primary float-right">
        {{ __('SHOW MORE') }}
    </a>
    <div class="col-sm-6">
        <h4 class="m-0 text-dark">PROGRAM PELATIHAN YANG DITAWARKAN</h4><br>
        <h6>Berikut adalah program pelatihan yang ditawarkan</h6>
    </div>
    <div class="row ">
        @foreach($ditawarkan as $d)
        <div class="col-sm-3 " style="display: flex;">
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
                    <img src="{{ asset('storage/'.$d->gambar_pelatihan.'') }}" style='width:100%; height:100%; padding: 10px' alt="gambar kejuruan">
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
<hr>
<br>
{{--PROGRAM MENTOR--}}
<div class="container">
    <a href="{{ url('sesiPelatihan/showMore/2') }}" class="button btn btn-outline-primary float-right">
        {{ __('SHOW MORE') }}
    </a>
    <div class="col-sm-6">
        <h4 class="m-0 text-dark">PROGRAM PELATIHAN DARI MENTOR</h4><br>
        <h6>Program yang disediakan dari para Mentor</h6>
    </div>
    <div class="row ">
        @foreach($programMentor as $d)
        <div class="col-sm-3 ">
            <div class="card card-primary ">
                <div class="ribbon-wrapper">
                    <div class="ribbon bg-info">
                        {{ $d->email_mentor }}
                    </div>
                </div>
                <div class="card-header">
                    <h3 class="card-title">{{ $d->nama_program }}</h3>
                </div>
                <div class="card-body">
                    <!-- <h1>GAMBAR KEJURUAN</h1> -->
                    <img src="{{ asset('storage/'.$d->gambar.'') }}" style='width:100%; height:100%; padding: 10px' alt="gambar kejuruan">
                </div>
                <div class="card-body">
                    <p>{{\Illuminate\Support\Str::limit($d->deskripsi_program,20,'...')}}.</p>
                </div>
                <div class="card-footer">
                    <a href="" class="button btn btn-primary">{{ __('DETAIL') }}</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<hr>
<br>
<div class="container">
    <a href="{{ url('sesiPelatihan/showMore/3') }}" class="button btn btn-outline-primary float-right">
        {{ __('SHOW MORE') }}
    </a>
    <div class="col-sm-6">
        <h4 class="m-0 text-dark">PROGRAM PELATIHAN YANG TERBAIK</h4><br>
        <h6>Berikut adalah program pelatihan Terbaik</h6>
    </div>
    <div class="row ">
        @foreach($other as $d)
        <div class="col-sm-3 ">
            <div class="card card-primary ">
                <div class="ribbon-wrapper">
                    <div class="ribbon bg-info">
                        BEST
                    </div>
                </div>
                <div class="card-header">
                    <h3 class="card-title">{{ $d->nama }}</h3>
                </div>
                <div class="card-body">
                    <!-- <h1>GAMBAR KEJURUAN</h1> -->
                    <img src="{{ asset('storage/'.$d->gambar.'') }}" style='width:100%; height:100%; padding: 10px' alt="gambar mentoring">
                </div>
                <div class="card-body">
                    <p>{{\Illuminate\Support\Str::limit($d->deskripsi,20,'...')}}.</p>
                </div>
                <div class="card-footer">
                    <a href="{{ $d->link }}" target="_blank" class="button btn btn-primary">{{ __('DETAIL') }}</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<hr>
<br>

@endif

@if(Auth::user()->role->nama_role == 'mentor')

@if(count($keahlian) === 0)
<div class="alert alert-warning" role="alert">
    <center>Anda belum mengisikan Keahlian Yang dimiliki &nbsp;&nbsp;&nbsp;
        <a href="{{ route('keahlianUser.index') }}" class="button btn btn-primary">ISI SEKARANG !</a>
    </center>
</div>
@endif

<div class="container">
    <div class="d-flex justify-content-between mb-2">
        <h2>Daftar Program</h2>
        @if(count($keahlian) != 0)
            @if(Auth::user()->nomor_identitas == null)
            <a href="{{url('pelatihanPeserta/lengkapiBerkas/'.Auth::user()->email)}}" class="button btn btn-warning">{{ __('TAMBAH PROGRAM')}}</a>
            @else
            <button class="btn btn-primary" data-toggle="modal" data-target="#modalTambahProgram">
                Tambah Program Baru
            </button>
            @endif
        @endif
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
                <th>Status</th>
                <th>AKSI</th>
            </tr>
        </thead>
        <tbody>
            @foreach($mentoring as $m)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $m->nama_program}}</td>
                <td>{{ $m->deskripsi_program}}</td>
                <td>{{ $m->tgl_dibuka}} - {{ $m->tgl_ditutup}}</td>
                <td>{{ $m->link_pendaftaran}}</td>
                <td>@if($m->is_validated == 1)
                    SUDAH DIVALIDASI
                    @else
                    BELUM DIVALIDASI
                    @endif
                </td>
                <td>
                    <a data-toggle="modal" data-target="#modalEditMentoring" class='btn btn-warning' onclick="modalEdit({{$m->id_mentoring}})">
                        <i class="fas fa-pen"></i>
                    </a>
                    <form method="POST" action="{{ route('mandiraMentoring.destroy',$m->id_mentoring) }}" onsubmit="return submitFormDelete(this);" class="d-inline">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger" data-toggle="modal"><i class="fas fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- MODAL --}}
<div class="modal fade" id="modalEditMentoring" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" id="modalContent">

    </div>
</div>

<div class="modal fade" id="modalTambahProgram" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Program Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('mandiraMentoring.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="nama" class="col-md-12 col-form-label">{{ __('Nama Program') }}</label>

                            <div class="col-md-12">
                                <input id="nama" type="text" class="form-control " name="nama_program" required autocomplete="nama">

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nama" class="col-md-12 col-form-label">{{ __('Deskripsi Program') }}</label>

                            <div class="col-md-12">
                                <input id="nama" type="text" class="form-control " name="deskripsi_program" required autocomplete="nama">

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="gambar" class="col-md-12 col-form-label">{{ __('Gambar Kegiatan') }}</label>
                            <input type="file" name='gambar' class="defaults" value="" required>
                        </div>
                        <div class="form-group">
                            <label for="tgl_dibuka" class="col-md-12 col-form-label">{{ __('Tanggal Buka Pendaftaran') }}</label>
                            <input type="datetime-local" class="col-md-12 col-form-label" name="tgl_dibuka">

                            <div class="col-md-12">

                                @error('website')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tgl_ditutup" class="col-md-12 col-form-label">{{ __('Tanggal Tutup Pendaftaran') }}</label>
                            <input type="datetime-local" class="col-md-12 col-form-label" name="tgl_ditutup">

                            <div class="col-md-12">

                                @error('website')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nama" class="col-md-12 col-form-label">{{ __('Link Pendaftaran') }}</label>

                            <div class="col-md-12">
                                <input id="nama" type="text" class="form-control " name="link_pendaftaran" required autocomplete="nama">

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nama" class="col-md-12 col-form-label">{{ __('Keahlian') }}</label>

                            <div class="col-md-12">
                                <select class="form-control" aria-label="Default select example" name="keahlians_idkeahlians" id="namaKeahlian" readonly>
                                    <option id="namaKeahlian" value=""></option>
                                    @foreach($daftarKeahlian as $k)
                                    <option id="namaKeahlian" value="{{$k->idkeahlians}}">{{$k->nama}}</option>
                                    @endforeach
                                </select>
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
    </div>
</div>

@endif


@if(Auth::user()->role->nama_role == 'adminblk' || Auth::user()->role->nama_role == 'superadmin')

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
                        <button type="submit" class="btn btn-danger" data-toggle="modal" href="" data-toggle="modal"><i class="fas fa-trash"></i>
                        </button>
                    </form>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


{{-- Modal tambah Instruktur --}}
@foreach($adminDashboard as $d)
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

@else
<div class="alert alert-danger" role="alert">
    <center>
        AKUN ANDA DI SUSPEND !
    </center>
</div>

@endif
@endsection