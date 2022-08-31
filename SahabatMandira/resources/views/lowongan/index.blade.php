@extends('layouts.adminlte')

@section('title')
Lowongan
@endsection

@section('javascript')
<script>
    $(function () {
        $("#myTable").DataTable({
            "responsive": true,
            "autoWidth": false,
        });
    });

    function modalEdit(lowonganId) {
        $.ajax({
            type: 'POST',
            url: '{{ route("lowongan.getEdit") }}',
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'id': lowonganId,
            },
            success: function (data) {
                $("#modalContent").html(data.msg);
            },
            error: function (xhr) {
                console.log(xhr);
            }
        });
    }

    function submitDelete(form) {
        swal({
                {
                    {}
                }
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


@section('contents')
<div class="container">
    <div class="d-flex justify-content-between mb-2">
        <h2>Daftar Lowongan {{ $perusahaan->nama }}</h2>
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalTambahLowongan">
            Tambah Lowongan
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
                <th>Nama</th>
                <th>Posisi</th>
                <th>Tanggal Pemasangan</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="myTable">
            @foreach($data_lowongan as $d)
            <tr>
                <td>{{ $d->nama }}</td>
                <td>{{ $d->posisi }}</td>
                <td>{{ $d->tanggal_pemasangan }}</td>
                <td>
                    <div class="text-center">
                        <a class="btn btn-sm btn-primary" href="{{ route('lamaran.show',$d->id) }}">
                            <i class="fas fa-folder">
                            </i>
                            View
                        </a>
                        <a data-toggle="modal" data-target="#modalEditLowongan" class='btn btn-sm btn-warning'
                            onclick="modalEdit({{$d->id}})">
                            <i class="fas fa-pencil-alt">
                            </i>
                            Edit
                        </a>
                        <form class="d-inline" method="POST" action="{{ route('lowongan.destroy',$d->id) }}"
                            onsubmit="return submitDelete(this);" class="d-inline">
                            @method('DELETE')
                            @csrf

                            <button type="submit" class="btn btn-sm btn-danger" data-toggle="modal"
                                data-toggle="modal"><i class="fas fa-trash">
                                </i>
                                Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="modalEditLowongan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" id="modalContent">

    </div>
</div>

<div class="modal fade" id="modalTambahLowongan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Lowongan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('lowongan.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="nama" class="col-md-12 col-form-label">{{ __('Nama Lowongan') }}</label>
                        <div class="col-md-12">
                            <input id="nama" type="text" class="form-control" name="nama">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="posisi" class="col-md-12 col-form-label">{{ __('Posisi') }}</label>
                        <div class="col-md-12">
                            <input id="posisi" type="text" class="form-control" name="posisi">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="lokasi_kerja" class="col-md-12 col-form-label">{{ __('Lokasi Kerja') }}</label>
                        <div class="col-md-12">
                            <input id="lokasi_kerja" type="text" class="form-control" name="lokasi_kerja">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jam_kerja" class="col-md-12 col-form-label">{{ __('Jam Kerja') }}</label>
                        <div class="col-md-12">
                            <input id="jam_kerja" type="number" class="form-control" name="jam_kerja">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="gaji" class="col-md-12 col-form-label">{{ __('Gaji') }}</label>
                        <div class="col-md-12">
                            <input id="gaji" type="text" class="form-control" name="gaji">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pengalaman_kerja"
                            class="col-md-12 col-form-label">{{ __('Pengalaman Kerja') }}</label>
                        <div class="col-md-12">
                            <input id="pengalaman_kerja" type="text" class="form-control" name="pengalaman_kerja">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pendidikan_terakhir"
                            class="col-md-12 col-form-label">{{ __('Kualifikasi Pendidikan') }}</label>
                        <div class="col-md-12">
                            <input id="pendidikan_terakhir" type="text" class="form-control" name="pendidikan_terakhir">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi_kerja"
                            class="col-md-12 col-form-label">{{ __('Deskripsi Kerja') }}</label>
                        <div class="col-md-12">
                            <textarea id="deskripsi_kerja" type="text" class="form-control" name="deskripsi_kerja"
                                rows="10"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="profile_perusahaan"
                            class="col-md-12 col-form-label">{{ __('Profile Perusahaan') }}</label>
                        <div class="col-md-12">
                            <textarea id="profile_perusahaan" type="text" class="form-control" name="profile_perusahaan"
                                rows="10"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_pemasangan"
                            class="col-md-12 col-form-label">{{ __('Tanggal Pemasangan') }}</label>
                        <div class="col-md-12">
                            <input id="tanggal_pemasangan" type="date" class="form-control" name="tanggal_pemasangan">
                        </div>
                    </div>

                    <input type="hidden" name="perusahaans_id" value="{{ Auth::user()->perusahaans_id_admin }}">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection
