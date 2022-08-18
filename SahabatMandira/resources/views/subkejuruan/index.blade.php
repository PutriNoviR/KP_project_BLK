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
                <th>ID</th>
                <th>NAMA SUB KEJURUAN</th>
                <th>DETAIL</th>
            </tr>
        </thead>
        <tbody>
            {{-- @foreach($data as $d)
            <tr>
                <td>{{ $d->id }}</td>
            <td>{{ $d->nama }}</td>
            <td>
                <a class="btn btn-primary" data-toggle="modal"
                    href="{{url('/menu/subkejuruan/detail/'.$d->idsub_kejuruans)}}" data-toggle="modal">detail</a>
            </td>
            </tr>
            @endforeach --}}
        </tbody>
    </table>
</div>
{{-- modal --}}
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
                            <label class="col-md-12 col-form-label">{{ __('Asal BLK') }}</label>

                            <div class="col-md-12">
                                <select class="form-control" aria-label="Default select example" name="blks_id">
                                    @foreach ($blks as $blk)
                                    <option value="{{ $blk->id }}">{{ $blk->nama }}</option>
                                    @endforeach
                                </select>
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
                            <label for="nama" class="col-md-12 col-form-label">{{ __('Nama Sub Kejuruan') }}</label>
                            <div class="col-md-12">
                                <input id="nama" type="text" class="form-control " name="nama_subkejuruan" required
                                    autocomplete="nama">
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
