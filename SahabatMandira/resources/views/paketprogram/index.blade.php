@extends('layouts.adminlte')

@section('title')
PAKET PROGRAM
@endsection


@section('javascript')
<script>
    $(function () {
        $("#myTable").DataTable({
            "responsive": true,
            "autoWidth": false,
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
            success: function (data) {
                // console.log(data.msg);
                $("#modalContent").html(data.msg);
            },
            error: function (xhr) {
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

    $('#selectKejuruan').on('change', function () {

        const idkejuruan = $('#selectKejuruan').val();

        $.ajax({
            type: 'POST',
            url: '{{ route("paketProgram.getSubKejuruan") }}',
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'idkejuruan': idkejuruan,
            },
            success: function (data) {
                $('#selectSubKejuruan').empty();
                data.forEach(e => {
                    $('#selectSubKejuruan').append(
                        `<option value="${e['id']}">${e['nama']}</option>`);
                });
                $('#selectSubKejuruan').removeAttr('disabled')
            },
            error: function (xhr) {
                console.log(xhr);
            }
        })
    })

</script>
@endsection

@section('contents')
<div class="container">
    <div class="d-flex justify-content-between mb-2">
        <h2>Daftar Paket Program dari BLK
        </h2>
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalTambahPaketProgram">
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
    <table class="table table-striped table-bordered table-hover dataTable no-footer" id="myTable" role="grid"
        aria-describedby="sample_1_info">
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
            @foreach($paketprograms as $paketprogram)
            {{-- @dd($paketprogram->subkejuruan) --}}
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $paketprogram->blk->nama }}</td> {{-- yang ada ->ambil dari function yang ada di modelnya --}}
                <td>{{ $paketprogram->kejuruan->nama }}</td>
                <td>{{ $paketprogram->subkejuruan->nama }}</td>
                <td>
                    <a data-toggle="modal" data-target="#modalTambahSesiPelatihan{{$paketprogram->id}}"
                        class='btn btn-warning'>
                        Tambah Sesi Pelatihan
                    </a>
                    <a data-toggle="modal" data-target="#modalEditPaketProgram" class='btn btn-warning'
                        onclick="modalEdit({{$paketprogram->id}})">
                        <i class="fas fa-pen"></i>
                    </a>
                    <form method="POST" action="{{ route('paketProgram.destroy',$paketprogram->id) }}"
                        onsubmit="return submitFormDelete(this);" class="d-inline">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger" data-toggle="modal"
                            href="{{route('blk.show',$paketprogram->id)}}" data-toggle="modal"><i
                                class="fas fa-trash"></i></button>
                    </form>
                </td>
            </tr>

            {{-- MODAL UNTUK TAMBAH SESI PELATIHAN--}}
            <div class="modal fade" id="modalTambahSesiPelatihan{{$paketprogram->id}}" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Sesi Pelatihan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('sesiPelatihan.store') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="deskripsi"
                                        class="col-md-12 col-form-label">{{ __('Deskripsi Pelatihan') }}</label>
                                    <input type="text" class="col-md-12 col-form-label" name="deskripsi">
                                </div>
                                <div class="form-group">
                                    <label for="fotoPelatihan"
                                        class="col-md-12 col-form-label">{{ __('Foto Pelatihan') }}</label>

                                    <input type="file" name='fotoPelatihan' class="defaults" value="" required>
                                </div>
                                <div class="form-group">
                                    <label for="tanggalBukaPendaftaran"
                                        class="col-md-12 col-form-label">{{ __('Tanggal Buka Pendaftaran') }}</label>
                                    <input type="datetime-local" class="col-md-12 col-form-label"
                                        name="tanggal_pendaftaran">

                                    <div class="col-md-12">

                                        @error('website')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="tanggalTutupPendaftaran"
                                        class="col-md-12 col-form-label">{{ __('Tanggal Tutup Pendaftaran') }}</label>
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
                                    <label for="tanggalMulaiPelatihan"
                                        class="col-md-12 col-form-label">{{ __('Tanggal Mulai Pelatihan') }}</label>
                                    <input type="datetime-local" class="col-md-12 col-form-label"
                                        name="tanggal_mulai_pelatihan">

                                    <div class="col-md-12">

                                        @error('website')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="tanggalSelesaiPelatihan"
                                        class="col-md-12 col-form-label">{{ __('Tanggal Selesai Pelatihan') }}</label>
                                    <input type="datetime-local" class="col-md-12 col-form-label"
                                        name="tanggal_selesai_pelatihan">

                                    <div class="col-md-12">

                                        @error('website')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="kuota" class="col-md-12 col-form-label">{{ __('Harga') }}</label>
                                    <input type="text" class="col-md-12 col-form-label" name="harga">
                                </div>

                                <div class="form-group">
                                    <label for="kuota" class="col-md-12 col-form-label">{{ __('Kuota') }}</label>
                                    <input type="text" class="col-md-12 col-form-label" name="kuota">
                                </div>

                                <div class="form-group">
                                    <label for="tanggalSeleksi"
                                        class="col-md-12 col-form-label">{{ __('Tanggal Seleksi') }}</label>
                                    <input type="datetime-local" class="col-md-12 col-form-label"
                                        name="tanggal_seleksi">

                                    <div class="col-md-12">

                                        @error('website')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="aktivitas"
                                        class="col-md-12 col-form-label">{{ __('Aktivitas') }}</label>
                                    <textarea class="col-md-12 col-form-label" rows="3"
                                        name="aktivitas">{{$paketprogram->subkejuruan->aktivitas}}</textarea>
                                    <input type="hidden" name="paket_program_id" class="col-md-12 col-form-label"
                                        value="{{$paketprogram->id}}">
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
            @endforeach
        </tbody>
    </table>
</div>

<div class="modal fade" id="modalTambahPaketProgram" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
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
                            <label for="nama"
                                class="col-md-12 col-form-label">{{ __('Nama Balai Latihan Kerja') }}</label>
                            <div class="col-md-12">
                                <select class="form-control" aria-label="Default select example" name="blks_id">
                                    <option selected>Pilih BLK</option>
                                    @foreach($blk as $d)
                                    <option value="{{$d->id}}">{{$d->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="kejuruan" class="col-md-12 col-form-label">{{ __('Kejuruan') }}</label>
                            <div class="col-md-12">
                                <select class="form-control" aria-label="Default select example" name="kejuruans_id"
                                    id="selectKejuruan">
                                    <option selected>Pilih Kejuruan</option>
                                    @foreach($kejuruan as $d)
                                    <option value="{{$d->id}}">{{$d->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12 col-form-label">{{ __('Sub Kejuruan') }}</label>
                            <div class="col-md-12">
                                <select class="form-control" aria-label="Default select example" name="sub_kejuruans_id"
                                    id="selectSubKejuruan" disabled>
                                </select>
                            </div>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
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
