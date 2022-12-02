<?php

use Illuminate\Support\Facades\Auth;
?>
@extends('layouts.adminlte')

@section('title')
Dashboard
@endsection

@section('javascript')
<script>
    let role = "<?= Auth::user()->role->nama_role ?>";
    $(function() {
        let parameter = {};
        if (role == 'adminblk') {
            parameter = {
                "responsive": true,
                "autoWidth": false,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'print',
                    {
                        extend: 'pdfHtml5',
                        customize: function(doc) {
                            doc.content.splice(1, 0);
                            var logo = 'data:image/png;base64,' + '<?= base64_encode(file_get_contents('https://seeklogo.com/images/J/jawa-timur-logo-24818906D1-seeklogo.com.png')) ?>'
                            doc.pageMargins = [20, 100, 20, 30]; //left,bottom,right,up
                            doc['header'] = (function() {
                                return {
                                    columns: [{
                                            image: logo,
                                            width: 45
                                        },
                                        {
                                            alignment: 'center',
                                            text: @if(count($blk) > 0)
                                            '{{$blk[0]->nama}}'
                                            @else ""
                                            @endif,
                                            fontSize: 18,
                                            margin: [10, 0]
                                        },
                                    ],
                                    margin: 20
                                }
                            });

                        },
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 8]
                        }
                    },
                    'colvis'
                ]
            }
        } else if (role == 'mentor' || role == 'verifikator' || role == 'superadmin') {
            parameter = {
                "responsive": true,
                "autoWidth": false,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'print',
                    {
                        extend: 'pdfHtml5',
                        customize: function(doc) {
                            doc.content.splice(1, 0);
                            var logo = 'data:image/png;base64,' + '<?= base64_encode(file_get_contents('https://seeklogo.com/images/J/jawa-timur-logo-24818906D1-seeklogo.com.png')) ?>'
                            doc.pageMargins = [20, 100, 20, 30];
                            doc['header'] = (function() {
                                return {
                                    columns: [{
                                            image: logo,
                                            width: 45
                                        },
                                        {
                                            alignment: 'center',
                                            text: 'Laporan ' + role,
                                            fontSize: 18,
                                            margin: [10, 0]
                                        },
                                    ],
                                    margin: 20
                                }
                            });

                        },
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        }
                    },
                    'colvis'
                ]
            }
        }
        $("#myTable").DataTable(parameter);
    });

    function editMentoring(id_mentoring) {
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

    function modalTambahInstuktur(idsesipelatihan) {
        $.ajax({
            type: 'POST',
            url: '{{ route("sesiPelatihan.getTambahInstruktur") }}',
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'id': idsesipelatihan
            },
            success: function(data) {
                $(`#modalContentTambahInstruktur`).html(data.msg);
            },
            error: function(xhr) {
                console.log(xhr);
            }
        });
    }

    function modalShowRiwayatInstruktur(email) {
        $.ajax({
            type: 'POST',
            url: '{{ route("sesiPelatihan.getRiwayatInstruktur") }}',
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'mentors_email': email,
            },
            success: function(data) {
                $(`#modalContentRiwayatInstruktur`).html(data.msg);
            },
            error: function(xhr) {
                console.log(xhr);
            }
        });
    }

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

    function alertShow(id) {
        $.ajax({
            type: 'POST',
            url: '{{ route("sesiPelatihan.getDetail") }}',
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'id': id,
            },
            success: function(data) {
                swal({
                    title: "Aktivitas",
                    text: data.data,
                })
            },
            error: function(xhr) {
                console.log(xhr);
            }
        });
    }


    $('body').on('change', '#nama_instruktur', function() {
        var email = $('#nama_instruktur').val();
        $('#btnRiwayatInstruktur').attr('onclick', `modalShowRiwayatInstruktur('${email}')`);
    });
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
    <center>Anda belum mengikuti tes kejuruan, Ikuti tes untuk mengetahui pelatihan yang sesuai dengan minat kejuruan
        anda ! &nbsp;&nbsp;&nbsp;
        <a href="https://ubayavii.id" class="button btn btn-primary" target="_blank">IKUTI TES SEKARANG !</a>
    </center>
</div>
@else
<div class="container">
    <div class="col-sm-6">
        <h4 class="m-0 text-dark">PROGRAM PELATIHAN</h4><br>
        <h6>Berikut adalah program pelatihan yang disarankan untuk diikuti pada Balai Latihan Kerja Disnakertrans Jawa
            Timur</h6>
    </div>

    <div class="row ">
        @foreach($disarankan as $d)
        <div class="col-sm-3" style="display: flex;">
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
                <div class="card-body" style="height:80% ;">
                    <!-- <h1>GAMBAR KEJURUAN</h1>{{-- ganti pake gambar ada di dalam sesi_pelatihans --}} -->
                    <img src="{{ asset('storage/'.$d->gambar_pelatihan.'') }}" style='width:100%; height:100%; padding: 10px' alt="gambar kejuruan">
                </div>
                <div class="card-body font-weight-bold">
                    {{ $d->paketprogram->subkejuruan->nama }}
                </div>
                <div class="card-body">
                    <p>{{\Illuminate\Support\Str::limit($d->deskripsi,50,'...')}}.</p> {{--ini belum ambil dari db--}}
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
        <h4 class="m-0 text-dark">PROGRAM PELATIHAN YANG DITAWARKAN DARI BALAI LATIHAN KERJA</h4><br>
        <h6>Berikut adalah program pelatihan yang ditawarkan oleh Balai Latihan Kerja</h6>
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
                <div class="card-header" style="height:20% ;">
                    <h3 class="card-title">{{ $d->paketprogram->kejuruan->nama }}</h3>
                </div>
                <div class="card-body" style="height:80% ;">
                    <!-- <h1>GAMBAR KEJURUAN</h1> -->
                    <img src="{{ asset('storage/'.$d->gambar_pelatihan.'') }}" style='width:100%; height:100%; padding: 10px' alt="gambar kejuruan">
                </div>
                <div class="card-body font-weight-bold">
                    {{ $d->paketprogram->subkejuruan->nama }}
                </div>
                <div class="card-body">
                    <p>{{\Illuminate\Support\Str::limit($d->deskripsi,50,'...')}}.</p>
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
        <div class="col-sm-3" style="display: flex;">
            <div class="card card-primary ">
                <div class="ribbon-wrapper">
                    <div class="ribbon bg-info">
                        {{ $d->email_mentor }}
                    </div>
                </div>
                <div class="card-header" style="height:30% ;">
                    <h3 class="card-title">{{ $d->nama_program }}</h3>
                </div>
                <div class="card-body" style="height:100% ;">
                    <!-- <h1>GAMBAR KEJURUAN</h1> -->
                    <img src="{{ asset('storage/'.$d->gambar.'') }}" style='width:100%; height:100%; padding: 10px' alt="gambar kejuruan">
                </div>
                <div class="card-body">
                    <p>{{\Illuminate\Support\Str::limit($d->deskripsi_program,50,'...')}}.</p>
                </div>
                <div class="card-footer">
                    <a href="{{url('mandiraMentoring/detail/'.$d->id_mentoring)}}" class="button btn btn-primary">{{ __('DETAIL') }}</a>
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
        <h4 class="m-0 text-dark">PROGRAM PELATIHAN YANG TERBAIK DARI UBAYA</h4><br>
        <h6>Berikut adalah program pelatihan yang ditawarkan oleh UBAYA GLOBAL ACADEMY</h6>
    </div>
    <div class="row ">
        @foreach($other as $d)
        <div class="col-sm-3" style="display: flex;">
            <div class="card card-primary ">
                <div class="ribbon-wrapper">
                    <div class="ribbon bg-info">
                        UGA
                    </div>
                </div>
                <div class="card-header" style="height:30% ;">
                    <h3 class="card-title">{{ $d->nama }}</h3>
                </div>
                <div class="card-body" style="height:100% ;">
                    <!-- <h1>GAMBAR KEJURUAN</h1> -->
                    <img src="{{ asset('storage/'.$d->gambar.'') }}" style='width:100%; height:100%; padding: 10px' alt="gambar mentoring">
                </div>
                <div class="card-body">
                    <p>{{\Illuminate\Support\Str::limit($d->deskripsi,50,'...')}}.</p>
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
                <th>Detail</th>
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
                    <a href="{{ url('pelatihanPesertas/'.$d->id) }}" class="button btn btn-warning">
                        <i class="fas fa-edit"></i> {{--PINDAHIN KE UI  --}}
                    </a>
                </td>
                <td>
                    <a href="{{ url('pelaporan/'.$d->id) }}" class="button btn btn-primary">
                        <i>DETAIL PESERTA</i> {{--PINDAHIN KE UI  --}}
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
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

        <button class="btn btn-primary" data-toggle="modal" data-target="#modalTambahProgram">
            Tambah Program Baru
        </button>
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
                    <a data-toggle="modal" data-target="#modalEditMentoring" class='btn btn-warning' onclick="editMentoring({{$m->id_mentoring}})">
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
                <th>Instruktur/Verifikator</th>
                <th>Lokasi</th>
                <th>Kuota</th>
                <th>Tanggal Seleksi</th>
                <th>Aktivitas</th>
                <th>Aksi</th>
                <th>Detail</th>
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
                <td>
                    @foreach($d->pelatihanmentor as $pm)
                    @if($loop->last)
                    {{$pm->nama_depan ." ".$pm->nama_belakang}}
                    @else
                    {{$pm->nama_depan ." ".$pm->nama_belakang.", "}}
                    <br>
                    @endif

                    @endforeach
                </td>
                <td>{{ $d->lokasi }}</td>
                <td>{{ $d->kuota }}</td>
                <td>{{ $d->tanggal_seleksi }}</td>
                <td><button class='btn btn-info' onclick="alertShow({{$d->id}})">
                        <i class="fas fa-eye"></i></td>
                <td>
                    <a data-toggle="modal" data-target="#modalTambahInstruktur" class='btn btn-warning' onclick="modalTambahInstuktur({{$d->id}})">
                        Tambah Instruktur
                    </a>
                    <a data-toggle="modal" data-target="#modalEditSesiPelatihan" class='btn btn-warning' onclick="modalEdit({{$d->id}})">
                        <i class="fas fa-pen"></i>
                    </a>
                    <form method="POST" action="" onsubmit="return submitFormDelete(this);" class="d-inline">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger" data-toggle="modal" href="" data-toggle="modal"><i class="fas fa-trash"></i>
                        </button>
                    </form>
                </td>
                <td>
                    <a href="{{ route('pelaporan.show',$d->id) }}" class="button btn btn-primary">
                        Detail Peserta</i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{-- Modal edit sesi --}}
<div class="modal fade" id="modalEditSesiPelatihan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" id="modalContent">

    </div>
</div>

{{-- Modal tambah Instruktur --}}
<div class="modal fade" id="modalTambahInstruktur" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" id="modalContentTambahInstruktur">

    </div>
</div>
<div class="modal fade" id="modalRiwayatInstuktur" tabindex="-1" aria-labelledby="modalRiwayatInstukturLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" id="modalContentRiwayatInstruktur">
        <div class="modal-content">

        </div>
    </div>
</div>


{{-- Modal Riwayat Instruktur --}}
@endif

@else
<div class="alert alert-danger" role="alert">
    <center>
        AKUN ANDA DI SUSPEND !
    </center>
</div>

@endif
@endsection