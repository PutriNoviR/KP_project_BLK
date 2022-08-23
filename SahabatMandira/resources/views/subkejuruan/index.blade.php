@extends('layouts.adminlte')

@section('title')
Daftar Sub Kejuruan
@endsection

@section('page-bar')
{{-- <ul class="page-breadcrumb">
    <li>
        <i class="fa fa-home"></i>
        <a href="http://127.0.0.1:8000/">Dashboard</a>
        <i class="fa fa-angle-right"></i>
    </li>

    <li>
        <a href="http://127.0.0.1:8000/menu/subkejuruan">Sub Kejuruan</a>
        <i class="fa fa-angle-right"></i>
    </li>
</ul> --}}
@endsection

@section('javascript')
<script>
    $(function () {
        $("#myTable").DataTable({
            "responsive": true,
            "autoWidth": false,
        });
    });

    function modalEdit(id) {
        $.ajax({
            type: 'POST',
            url: '{{ route("subkejuruan.getEditForm") }}',
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'id': id,
            },
            success: function (data) {
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

    function alertShow(id) {
        $.ajax({
            type: 'POST',
            url: '{{ route("subkejuruan.getDetail") }}',
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'id': id,
            },
            success: function (data) {
                swal({
                    title: "Aktivitas",
                    text: data.data,
                })
            },
            error: function (xhr) {
                console.log(xhr);
            }
        });
    }

</script>
@endsection

@section('contents')
<div class="container">
    <div class="d-flex justify-content-between mb-2">
        <h2>Daftar Sub Kejuruan</h2>
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">
            Tambah Sub Kejuruan Baru
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
                <th>SUB KEJURUAN</th>
                <th>KEJURUAN</th>
                <th>KATEGORI</th>
                <th>KLASTER</th>
                <th>AKSI</th>
            </tr>
        </thead>
        <tbody>
            @foreach($subs as $sub)
            <tr>
                <td>{{ $sub->nama }}</td>
                <td>{{ $sub->kejuruan->nama }}</td>
                <td>{{ $sub->kategori->nama }}</td>
                <td>{{ $sub->klaster->nama }}</td>
                <td>
                    <button class='btn btn-info' onclick="alertShow({{$sub->id}})">
                        <i class="fas fa-eye"></i>
                    </button>
                    <a data-toggle="modal" data-target="#modalEditSubKejuruan" class='btn btn-warning'
                        onclick="modalEdit({{$sub->id}})">
                        <i class="fas fa-pen"></i>
                    </a>
                    <form method="POST" action="{{ route('subkejuruan.destroy',$sub->id) }}"
                        onsubmit="return submitFormDelete(this);" class="d-inline">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger" data-toggle="modal"><i
                                class="fas fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{-- modal --}}
<div class="modal fade" id="modalEditSubKejuruan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" id="modalContent">

    </div>
</div>

<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Sub Kejuruan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <form method="POST" action="{{ route('subkejuruan.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="nama" class="col-md-12 col-form-label">{{ __('Nama Sub Kejuruan') }}</label>
                            <div class="col-md-12">
                                <input id="nama" type="text" class="form-control " name="nama_subkejuruan" required
                                    autocomplete="nama">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nama" class="col-md-12 col-form-label">{{ __('aktivitas') }}</label>
                            <div class="col-md-12">
                                <!-- <input id="aktivitas" type="text" class="form-control " name="aktivitas" required autocomplete="aktivitas"> -->
                                <textarea name="aktivitas" class="form-control" required id="aktivitas" cols="40"
                                    rows="10"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nama" class="col-md-12 col-form-label">{{ __('Nama Kejuruan') }}</label>
                            <div class="col-md-12">
                                <select class="form-control" aria-label="Default select example" name="kejuruans_id">
                                    @foreach ($kejuruans as $kej)
                                    <option value="{{ $kej->id }}">{{ $kej->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nama" class="col-md-12 col-form-label">{{ __('Kategori Psikometrik') }}</label>
                            <div class="col-md-12">
                                <select class="form-control" aria-label="Default select example" name="kode_kategori">
                                    @foreach ($kategoris as $kat)
                                    <option value="{{ $kat->id }}">{{ $kat->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nama" class="col-md-12 col-form-label">{{ __('Klaster Psikometrik') }}</label>
                            <div class="col-md-12">
                                <select class="form-control" aria-label="Default select example" name="kode_klaster">
                                    @foreach ($klasters as $klaster)
                                    <option value="{{ $klaster->id }}">{{ $klaster->nama }}</option>
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
        @endsection
