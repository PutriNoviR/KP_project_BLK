@extends('layouts.adminlte')

@section('title')
PELATIHAN MTU
@endsection



@section('javascript')

<script>
    $(document).ready(function() {
        $("#myTable").DataTable({
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
                                        text: '',
                                        fontSize: 18,
                                        margin: [10, 0]
                                    },
                                ],
                                margin: 20
                            }
                        });

                    },
                    exportOptions: {
                        columns: [0, 1, 2, 3, 5]
                    }
                },
                'colvis'
            ]
        });
    });

    function modalEdit(paketProgramId) {
        $.ajax({
            type: 'POST',
            url: '{{ route("paketProgram.getEditForm") }}',
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'id': paketProgramId,
            },
            success: function(data) {
                $("#modalContent").html(data.msg);
            },
            error: function(xhr) {
                console.log(xhr);
            }
        });
    }

    function submitFormDisetujui(form) {
        swal({
                title: "Peringatan!",
                text: "Apakah anda yakin ingin menyetujui pengajuan MTU ini?",
                icon: "warning",
                buttons: true,
                dangerMode: false,
            })
            .then((willDelete) => {
                if (willDelete) {
                    form.submit();
                }
            });
        return false;
    }

    function submitFormDitolak(form) {
        swal({
                title: "Peringatan!",
                text: "Apakah anda yakin ingin menolak pengajuan MTU ini?",
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

    $('#selectKejuruan').on('change', function() {

        const idkejuruan = $('#selectKejuruan').val();

        $.ajax({
            type: 'POST',
            url: '{{ route("paketProgram.getSubKejuruan") }}',
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'idkejuruan': idkejuruan,
            },
            success: function(data) {
                $('#selectSubKejuruan').empty();
                $('#selectSubKejuruan').append('<option></option>');
                data.forEach(e => {
                    $('#selectSubKejuruan').append(
                        `<option value="${e['id']}">${e['nama']}</option>`);
                });
                $('#selectSubKejuruan').removeAttr('disabled')
            },
            error: function(xhr) {
                console.log(xhr);
            }
        })
    });

    $('.blk-select2').select2({
        dropdownParent: '#modalTambahMTU',
        width: '100%',
        placeholder: 'Silahkan Tentukan UPT BLK',
        allowClear: true
    });

    window.editors = {};

    document.querySelectorAll('.deskripsi').forEach((node, index) => {
        ClassicEditor
            .create(node, {})
            .then(newEditor => {
                window.editors[index] = newEditor
            });
    });

    $(".addRow").click(function() {
        var limitCheck = $('#dynRow tr').length;
        if (limitCheck <= 16) {
            $("#dynRow").append(
                '<tr>' +
                '<td><input type="text" class="form-control" name="name[]"></td>' +
                '<td><input type="text" class="form-control" name="no_telp[]"></td>' +
                '<td><input type="file" class="form-control" name="ktp[]"></td>' +
                '<td><input type="file" class="form-control" name="ijazah[]"></td>' +
                '<td><button class="btn btn-danger deleteRow"><i class="fas fa-trash"></i></button></td>' +
                '</tr>'
            );
        } else {
            alert('Jumlah Peserta Tidak Boleh Melebihi 16 Orang !');
        }
    });

    $("#dynRow").on('click', '.deleteRow', function() {
        $(this).parent().parent().remove();
    });

    $('.blk-select2').change(function() {
        var blk_id = $(this).val();

        $.ajax({
            type: 'POST',
            url: '{{ route("mtu.program") }}',
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'id': blk_id,
            },
            success: function(data) {
                console.log(data);
                $('.program-select2').empty();
                $('.program-select2').append('<option></option>');

                for (var i = 0; i < data.length; i++) {
                    $('.program-select2').append('<option value="' + data[i]['id'] + '">' + data[i]["nama"] + '</option>');
                }

                $('.program-select2').select2({
                    dropdownParent: '#modalTambahMTU',
                    width: '100%',
                    placeholder: 'Silahkan Tentukan Paket Program',
                    allowClear: true
                });

            },
            error: function(xhr) {
                console.log(xhr);
            }
        });
    });

    // document.querySelectorAll('.activity').forEach((node, index) => {
    //     ClassicEditor
    //         .create(node, {})
    //         .then(newEditor => {
    //             window.editors[index] = newEditor
    //         });
    // });
</script>
@endsection

@section('contents')

@if(auth()->user()->role->nama_role == 'adminblk')
<div class="container">
    <div class="d-flex justify-content-between mb-2">
        <h2>List Pengajuan Pelatihan MTU</h2>

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
                <th>Email Pemohon</th>
                <th>Sub Kejuruan</th>
                <th>Lokasi Pelatihan</th>
                <th>Daftar Peserta</th>
                <th>Lampiran Dokumen</th>
                <th>Aksi Persetujuan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mtu as $m)
            <tr role="row">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $m->email_pic }}</td>
                <td>{{ $m->program }}</td>
                <td>{{ $m->deskripsi_tempat }}</td>
                <td><a href="{{ route('mtu.show',$m->idpelatihan_mtus) }}" class="button btn btn-primary">
                        Daftar Peserta</i>
                    </a></td>
                <td>
                    <button href="{{ asset('storage/'.$m->proposal) }}" class="btn btn-primary mb-1" style="width: 100%" download="PROPOSAL_{{Auth::user()->email."_".$m->proposal}}"><i class="fas fa-print"></i> &nbsp;PROPOSAL</button>
                    <a href hidden id="download-file"></a>

                    <button href="{{ asset('storage/'.$m->surat_pengantar) }}" 
                        class="btn btn-success" style="width: 100%" download="SURATPENGANTAR_{{Auth::user()->email."_".$m->surat_pengantar}}" @if(empty($m->surat_pengantar)) disabled @endif><i class="fas fa-print"></i> &nbsp;SURAT PENGANTAR</button>
                    {{--cek dulu dia ada ga pengantarnya kalo gaada disable--}}

                    <a href hidden id="download-file"></a>
                </td>
                <td>
                    <form method="POST" action="{{ route('mtu.persetujuan') }}" onsubmit="return submitFormDisetujui(this);" class="d-inline">
                        @method('POST')
                        @csrf

                        <input type="hidden" value="{{$m->idpelatihan_mtus}}" name="id_mtu">
                        <input type="hidden" value="1" name="persetujuan">

                        <button type="submit" class="btn btn-success mb-1" style="width: 100%">
                            SETUJUI
                        </button>
                    </form>

                    <form method="POST" action="{{ route('mtu.persetujuan') }}" onsubmit="return submitFormDitolak(this);" class="d-inline">
                        @method('POST')
                        @csrf

                        <input type="hidden" value="{{$m->idpelatihan_mtus}}" name="id_mtu">
                        <input type="hidden" value="2" name="persetujuan">

                        <button type="submit" class="btn btn-danger mb-1" style="width: 100%">
                            TOLAK
                        </button>
                    </form>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@elseif(auth()->user()->role->nama_role == 'peserta')
<div class="container">
    <div class="d-flex justify-content-between mb-2">
        <h2>Pelatihan MTU Yang Pernah Diajukan
        </h2>
        <button class="btn btn-success" data-toggle="modal" data-target="#modalTambahMTU">
            <i class="fas fa-plus-circle"></i> &nbsp; Pengajuan Baru
        </button>

    </div>
    @if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
    @endif
    @if (\Session::has('error'))
    <div class="alert alert-danger">
        <ul>
            <li>{!! \Session::get('error') !!}</li>
        </ul>
    </div>
    @endif
    <table class="table table-striped table-bordered table-hover dataTable no-footer" id="myTable" role="grid" aria-describedby="sample_1_info">
        <thead>
            <tr role="row">
                <th>No</th>
                <th>Balai Latihan Kerja</th>
                <th>Sub Kejuruan</th>
                <th>Periode Pelatihan</th>
                <th>Peserta Pelatihan</th>
                <th>Status Pengajuan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mtu as $m)
            <tr role="row">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $m->blk }}</td>
                <td>{{ $m->program }}</td>
                <td>{{ $m->waktu_mulai.' - '.$m->waktu_selesai }}</td>
                <td><button class="btn btn-info" onclick="alert('Ditambahkan sendiri ya! hahaha');"> <i class="fas fa-info-circle"></i></button></td>
                <td>@if($m->is_accepted == 1) Diterima @elseif($m->is_accepted == 2) Ditolak @else Dalam Proses @endif</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif

{{-- MODAL UNTUK TAMBAH PELATIHAN MTU--}}
<div class="modal fade" id="modalTambahMTU" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="max-width: 80% !important;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Pengajuan Pelatihan MTU</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('mtu.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="blk" class="col-md-12 col-form-label">{{ __('Balai Latihan Kerja') }}</label>
                        <!-- <input type="text" class="col-md-12 col-form-label" name="deskripsi"> -->
                        <select class="blk-select2 form-control" name="blk">
                            <option></option>
                            @foreach ($blk as $b)
                            <option value="{{ $b->id }}">{{ $b->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-md-12 col-form-label">{{ __('Program Pelatihan') }}</label>
                        <!-- <input type="text" class="col-md-12 col-form-label" name="deskripsi"> -->
                        <select class="program-select2 form-control" name="program">
                            <option>Silahkan Tentukan BLK Terlebih Dahulu !</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi" class="col-md-12 col-form-label">{{ __('Deskripsi Pelatihan') }}</label>
                        <!-- <input type="text" class="col-md-12 col-form-label" name="deskripsi"> -->
                        <textarea name="deskripsi" class="form-control deskripsi" id="deskripsi" cols="40" rows="10"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="proposalMtu" class="col-md-12 col-form-label">{{ __('Proposal Pelatihan') }}</label>
                        <input type="file" name='proposal' class="defaults" required>
                    </div>

                    <div class="form-group">
                        <label for="surat_pengantar" class="col-md-12 col-form-label">{{ __('Surat Pengantar') }}</label>
                        <input type="file" name='surat_pengantar' class="defaults">
                    </div>

                    <div class="form-group">
                        <label for="lokasi" class="col-md-12 col-form-label">{{ __('Lokasi') }}</label>
                        <input type="text" class="col-md-12 col-form-label" name="lokasi">
                    </div>

                    <div class="form-group">
                        <label class="col-md-12 col-form-label">{{ __('Daftar Peserta Pelatihan') }}</label>
                        <table class="table table-striped table-bordered table-hover dataTable">
                            <thead>
                                <tr>
                                    <td>Nama Lengkap</td>
                                    <td>No. Telepon</td>
                                    <td>KTP</td>
                                    <td>Ijazah</td>
                                    <td><button class="btn btn-primary addRow" type="button"><i class="fas fa-plus"></i></button></td>
                                </tr>
                            </thead>
                            <tbody id="dynRow">
                                <tr>
                                    <td><input type="text" class="form-control" name="name[]"></td>
                                    <td><input type="text" class="form-control" name="no_telp[]"></td>
                                    <td><input type="file" class="form-control" name="ktp[]"></td>
                                    <td><input type="file" class="form-control" name="ijazah[]"></td>
                                    <td>-</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td>Nama Lengkap</td>
                                    <td>No. Telepon</td>
                                    <td>KTP</td>
                                    <td>Ijazah</td>
                                    <td><button class="btn btn-primary addRow" type="button"><i class="fas fa-plus"></i></button></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div class="form-group">
                        <label for="tanggalMulaiPelatihan" class="col-md-12 col-form-label">{{ __('Tanggal Mulai Pelatihan') }}</label>
                        <input type="datetime-local" class="col-md-12 col-form-label" name="tanggal_mulai_pelatihan">

                        <div class="col-md-12">

                            @error('website')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tanggalSelesaiPelatihan" class="col-md-12 col-form-label">{{ __('Tanggal Selesai Pelatihan') }}</label>
                        <input type="datetime-local" class="col-md-12 col-form-label" name="tanggal_selesai_pelatihan">

                        <div class="col-md-12">

                            @error('website')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="sumberDana" class="col-md-12 col-form-label">{{ __('Sumber Dana') }}</label>
                        <div class="col-md-12">
                            <select class="form-control" aria-label="Default select example" name="sumberDana">
                                <option value="SWADANA" selected>SWADANA</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="harga" class="col-md-12 col-form-label">{{ __('Harga') }}</label>
                        <input type="text" class="col-md-12 col-form-label" name="harga" placeholder="0">
                    </div>

                    <div class="form-group">
                        <label for="jamPelajaran" class="col-md-12 col-form-label">{{ __('Jam Pelajaran') }}</label>
                        <input type="text" onkeypress="return /[0-9]/i.test(event.key)" class="col-md-12 col-form-label" name="jamPelajaran" value="430">
                    </div>
                    {{--
                    <div class="form-group">
                        <label for="aktivitas" class="col-md-12 col-form-label">{{ __('Aktivitas') }}</label>
                    <textarea class="col-md-12 col-form-label activity" rows="3" id="activity" name="aktivitas">{{$paketprogram->subkejuruan->aktivitas}}</textarea>
                    <input type="hidden" name="paket_program_id" class="col-md-12 col-form-label" value="{{$paketprogram->id}}">
            </div> --}}
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal">BATAL</button>
                <button type="submit" class="btn btn-success btn-lg">AJUKAN</button>
            </div>
            </form>
        </div>
    </div>
</div>
</div>

@endsection