@extends('layouts.adminlte')

@section('title')
PAKET PROGRAM
@endsection

@section('head')
<!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
  
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script> -->
  
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
                        columns: [0, 1, 2, 3]
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
        dropdownParent: '#modalTambahPaketProgram',
        width: '100%',
        placeholder: 'Silahkan Tentukan UPT BLK',
        allowClear: true
    });

    $('.kjr-select2').select2({
        dropdownParent: '#modalTambahPaketProgram',
        width: '100%',
        placeholder: 'Silahkan Tentukan Kejuruan',
        allowClear: true
    });

    $('.skjr-select2').select2({
        dropdownParent: '#modalTambahPaketProgram',
        width: '100%',
        placeholder: 'Silahkan Tentukan Sub-Kejuruan',
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

    document.querySelectorAll('.activity').forEach((node, index) => {
        ClassicEditor
            .create(node, {})
            .then(newEditor => {
                window.editors[index] = newEditor
            });
    });
</script>
@endsection

@section('contents')
<div class="container">
    <div class="d-flex justify-content-between mb-2">
        <h2>Daftar Paket Program dari BLK
        </h2>
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalTambahPaketProgram">
            <i class="fas fa-plus-circle"></i> &nbsp;Paket Program Baru
        </button>

    </div>
    @if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
    @endif
    @if (\Session::has('failed'))
    <div class="alert alert-danger">
        <ul>
            <li>{!! \Session::get('failed') !!}</li>
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
                <th>Tambah Sesi</th>
                {{-- <th>Tambah MTU</th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach($paketprograms as $paketprogram)
            {{-- @dd($paketprogram->subkejuruan) --}}
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $paketprogram->blk->nama }}</td> {{-- yang ada ->ambil dari function yang ada di modelnya --}}
                <td>{{ $paketprogram->kejuruan->nama }}</td>
                <td>{{ $paketprogram->subkejuruan->nama }}</td>
                <td>
                    <a data-toggle="modal" data-target="#modalTambahSesiPelatihan{{$paketprogram->id}}" class='btn btn-success text-white'>
                        <i class="fas fa-plus-circle"></i> &nbsp;Sesi Pelatihan
                    </a>
                    <!-- <a data-toggle="modal" data-target="#modalEditPaketProgram" class='btn btn-warning' onclick="modalEdit({{$paketprogram->id}})">
                        <i class="fas fa-pen"></i>
                    </a> -->
                    <!-- {{-- <form method="POST" action="{{ route('paketProgram.destroy',$paketprogram->id) }}" onsubmit="return submitFormDelete(this);" class="d-inline">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger" data-toggle="modal" href="{{route('blk.show',$paketprogram->id)}}" data-toggle="modal"><i class="fas fa-trash"></i></button>
                    </form> --}} -->
                </td>
                {{-- <td>
                    <a data-toggle="modal" data-target="#modalTambahMTU{{$paketprogram->id}}" class='btn btn-info text-white'>
                        <i class="fas fa-plus-circle"></i> &nbsp;MTU
                    </a>
                </td> --}}
            </tr>

            {{-- MODAL UNTUK TAMBAH SESI PELATIHAN--}}
            <div class="modal fade" id="modalTambahSesiPelatihan{{$paketprogram->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Sesi Pelatihan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('sesiPelatihan.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="deskripsi" class="col-md-12 col-form-label">{{ __('Deskripsi Pelatihan') }}</label>
                                    <!-- <input type="text" class="col-md-12 col-form-label" name="deskripsi"> -->
                                    <textarea name="deskripsi" class="form-control deskripsi" id="deskripsi" cols="40" rows="10"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="fotoPelatihan" class="col-md-12 col-form-label">{{ __('Foto Pelatihan') }}</label>
                                    <input type="file" name='fotoPelatihan' class="defaults" accept="image/png, image/gif, image/jpeg">
                                </div>
                                <div class="form-group">
                                    <label for="tanggalBukaPendaftaran" class="col-md-12 col-form-label">{{ __('Tanggal Buka Pendaftaran') }}</label>
                                    <input type="datetime-local" class="col-md-12 col-form-label" name="tanggal_pendaftaran">

                                    <div class="col-md-12">

                                        @error('website')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="tanggalTutupPendaftaran" class="col-md-12 col-form-label">{{ __('Tanggal Tutup Pendaftaran') }}</label>
                                    <input type="datetime-local" class="col-md-12 col-form-label" name="tanggal_tutup">

                                    <div class="col-md-12">

                                        @error('website')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="lokasi" class="col-md-12 col-form-label">{{ __('Lokasi') }}</label>
                                    <input type="text" class="col-md-12 col-form-label" name="lokasi">
                                </div>

                                <div class="form-group">
                                    <label for="tanggalSeleksi" class="col-md-12 col-form-label">{{ __('Tanggal Seleksi') }}</label>
                                    <input type="datetime-local" class="col-md-12 col-form-label" name="tanggal_seleksi">

                                    <div class="col-md-12">

                                        @error('website')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="tanggalMulaiDaftarUlang" class="col-md-12 col-form-label">{{ __('Tanggal Mulai Daftar Ulang') }}</label>
                                    <input type="datetime-local" class="col-md-12 col-form-label" name="tanggalMulaiDaftarUlang">

                                    <div class="col-md-12">

                                        @error('tanggalMulaiDaftarUlang')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="tanggalSelesaiDaftarUlang" class="col-md-12 col-form-label">{{ __('Tanggal Selesai Daftar Ulang') }}</label>
                                    <input type="datetime-local" class="col-md-12 col-form-label" name="tanggalSelesaiDaftarUlang">

                                    <div class="col-md-12">

                                        @error('tanggalSelesaiDaftarUlang')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
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
                                            <option value="APBN">APBN</option>
                                            <option value="APBD">APBD</option>
                                            <option value="SWADANA">SWADANA</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="harga" class="col-md-12 col-form-label">{{ __('Harga') }}</label>
                                    <input type="text" class="col-md-12 col-form-label" name="harga">
                                </div>

                                <div class="form-group">
                                    <label for="kuota" class="col-md-12 col-form-label">{{ __('Kuota Pelatihan') }}</label>
                                    <input type="number" class="col-md-12 col-form-label" name="kuota">
                                </div>

                                <div class="form-group">
                                    <label for="kuota_daftar" class="col-md-12 col-form-label">{{ __('Kuota Pendaftaran') }}</label>
                                    <input type="number" class="col-md-12 col-form-label" name="kuota_daftar">
                                </div>

                                <div class="form-group">
                                    <label for="jamPelajaran" class="col-md-12 col-form-label">{{ __('Jam Pelajaran') }}</label>
                                    <input type="text" onkeypress="return /[0-9]/i.test(event.key)" class="col-md-12 col-form-label" name="jamPelajaran" value="430">
                                </div>

                                <div class="form-group">
                                    <label for="kuota" class="col-md-12 col-form-label">{{ __('Nomor Surat') }}</label>
                                    <input type="text" class="col-md-12 col-form-label" name="nomorSurat" value="No. - / - / - . - . - / -">
                                </div>

                                <div class="form-group">
                                    <label for="tanggalSurat" class="col-md-12 col-form-label">{{ __('Tanggal Surat') }}</label>
                                    <input type="datetime-local" class="col-md-12 col-form-label" name="tanggalSurat" value="<?php echo date('Y-m-d\TH:i', strtotime('+0 hours')); ?>">

                                    <div class="col-md-12">

                                        @error('website')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="tanggalSertif" class="col-md-12 col-form-label">{{ __('Tanggal Sertifikat') }}</label>
                                    <input type="datetime-local" class="col-md-12 col-form-label" name="tanggalSertif" value="<?php echo date('Y-m-d\TH:i', strtotime('+0 hours')); ?>">

                                    <div class="col-md-12">

                                        @error('website')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="nilaiMinimalLulus" class="col-md-12 col-form-label">{{ __('Minimal Kelulusan') }}</label>
                                    <input type="number" class="col-md-12 col-form-label" name="nilaiMinimalLulus">
                                </div>

                                <div class="form-group">
                                    <label for="aktivitas" class="col-md-12 col-form-label">{{ __('Aktivitas') }}</label>
                                    <textarea class="col-md-12 col-form-label activity" rows="3" id="activity" name="aktivitas">{{$paketprogram->subkejuruan->aktivitas}}</textarea>
                                    <input type="hidden" name="paket_program_id" class="col-md-12 col-form-label" value="{{$paketprogram->id}}">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">BATAL</button>
                                    <button type="submit" class="btn btn-primary">SIMPAN</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            {{-- MODAL UNTUK TAMBAH PELATIHAN MTU--}}
            <div class="modal fade" id="modalTambahMTU{{$paketprogram->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Pelatihan MTU - {{$paketprogram->subkejuruan->nama}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('sesiPelatihan.mtu') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="deskripsi" class="col-md-12 col-form-label">{{ __('Deskripsi Pelatihan') }}</label>
                                    <!-- <input type="text" class="col-md-12 col-form-label" name="deskripsi"> -->
                                    <textarea name="deskripsi" class="form-control deskripsi" id="deskripsi" cols="40" rows="10"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="fotoPelatihan" class="col-md-12 col-form-label">{{ __('Foto Pelatihan') }}</label>
                                    <input type="file" name='fotoPelatihan' class="defaults" accept="image/png, image/gif, image/jpeg">
                                </div>
                                <div class="form-group">
                                    <label for="tanggalBukaPendaftaran" class="col-md-12 col-form-label">{{ __('Tanggal Buka Pendaftaran') }}</label>
                                    <input type="datetime-local" class="col-md-12 col-form-label" name="tanggal_pendaftaran">

                                    <div class="col-md-12">

                                        @error('website')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="tanggalTutupPendaftaran" class="col-md-12 col-form-label">{{ __('Tanggal Tutup Pendaftaran') }}</label>
                                    <input type="datetime-local" class="col-md-12 col-form-label" name="tanggal_tutup">

                                    <div class="col-md-12">
                                        @error('website')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="lokasi" class="col-md-12 col-form-label">{{ __('Lokasi') }}</label>
                                    <input type="text" class="col-md-12 col-form-label" name="lokasi">
                                </div>

                                <div class="form-group">
                                    <label for="tanggalMulaiDaftarUlang" class="col-md-12 col-form-label">{{ __('Tanggal Mulai Daftar Ulang') }}</label>
                                    <input type="datetime-local" class="col-md-12 col-form-label" name="tanggalMulaiDaftarUlang">

                                    <div class="col-md-12">

                                        @error('tanggalMulaiDaftarUlang')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="tanggalSelesaiDaftarUlang" class="col-md-12 col-form-label">{{ __('Tanggal Selesai Daftar Ulang') }}</label>
                                    <input type="datetime-local" class="col-md-12 col-form-label" name="tanggalSelesaiDaftarUlang">

                                    <div class="col-md-12">

                                        @error('tanggalSelesaiDaftarUlang')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
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
                                    <label for="kuota" class="col-md-12 col-form-label">{{ __('Kuota Pelatihan') }}</label>
                                    <input type="number" placeholder="16" class="col-md-12 col-form-label" name="kuota">
                                </div>

                                <div class="form-group">
                                    <label for="kuota_daftar" class="col-md-12 col-form-label">{{ __('Kuota Pendaftaran') }}</label>
                                    <input type="number" placeholder="40" class="col-md-12 col-form-label" name="kuota_daftar">
                                </div>

                                <div class="form-group">
                                    <label for="jamPelajaran" class="col-md-12 col-form-label">{{ __('Jam Pelajaran') }}</label>
                                    <input type="text" onkeypress="return /[0-9]/i.test(event.key)" class="col-md-12 col-form-label" name="jamPelajaran" value="430">
                                </div>

                                <div class="form-group">
                                    <label for="aktivitas" class="col-md-12 col-form-label">{{ __('Aktivitas') }}</label>
                                    <textarea class="col-md-12 col-form-label activity" rows="3" id="activity" name="aktivitas">{{$paketprogram->subkejuruan->aktivitas}}</textarea>
                                    <input type="hidden" name="paket_program_id" class="col-md-12 col-form-label" value="{{$paketprogram->id}}">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">BATAL</button>
                                    <button type="submit" class="btn btn-primary">SIMPAN</button>
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

<div class="modal fade" id="modalTambahPaketProgram" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <form method="POST" action="{{ route('paketProgram.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="nama" class="col-md-12 col-form-label">{{ __('Nama Balai Latihan Kerja') }}</label>
                            <div class="col-md-12">

                                @if (Auth::user()->role->nama_role == 'superadmin')
                                <select class="blk-select2 form-control" aria-label="Default select example" name="blks_id">
                                    <option></option>
                                    @foreach($blk as $d)
                                    <option value="{{$d->id}}">
                                        {{$d->nama}}
                                    </option>
                                    {{-- untuk melakukan pengecekan seperti if apakah id blk yang ada di paket program sama dengan id blk yang ada di foreach ?--}}
                                    @endforeach
                                </select>
                                @else
                                <select class="blk-select2 form-control " aria-label="Default select example" name="blks_id" readonly>
                                    <option></option>
                                    @foreach($blk as $d)
                                    <option value="{{$d->id}}">
                                        {{$d->nama}}
                                    </option>
                                    {{-- untuk melakukan pengecekan seperti if apakah id blk yang ada di paket program sama dengan id blk yang ada di foreach ?--}}
                                    @endforeach
                                </select>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="kejuruan" class="col-md-12 col-form-label">{{ __('Kejuruan') }}</label>
                            <div class="col-md-12">
                                <select class="form-control kjr-select2" aria-label="Default select example" name="kejuruans_id" id="selectKejuruan">
                                    <option></option>
                                    @foreach($kejuruan as $d)
                                    <option value="{{$d->id}}">{{$d->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12 col-form-label">{{ __('Sub Kejuruan') }}</label>
                            <div class="col-md-12">
                                <select class="form-control skjr-select2" aria-label="Default select example" name="sub_kejuruans_id" id="selectSubKejuruan" readonly>
                                    <option></option>
                                    @foreach($subKejuruan as $d)
                                    <option value="{{$d->id}}" name="sub_kejuruans_id">{{$d->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>


{{-- BUAT PANGGIL MODAL YANG ADA DI MODAL.BLADE --}}
<!-- Modal -->
<div class="modal fade" id="modalEditPaketProgram" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" id="modalContent">

    </div>
</div>


@endsection