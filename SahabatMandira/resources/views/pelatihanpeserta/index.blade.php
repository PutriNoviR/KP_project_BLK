@extends('layouts.adminlte')

@section('title')
Pelatihan Peserta
@endsection
@section('javascript')
<script>
    $(function () {
        $("#myTable").DataTable({
            "responsive": true,
            "autoWidth": false,
        });
    });

    function modalEdit(sesi_pelatihans_id) {
        $.ajax({
            type: 'POST',
            url: '{{ route("pelatihanPesertas.getEditForm") }}',
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'sesi_pelatihans_id': sesi_pelatihans_id,
            },
            success: function (data) {
                $("#modalContent").html(data.msg);
            },
            error: function (xhr) {
                console.log(xhr);
            }
        });
    }

</script>
@endsection


@section('page-bar')
{{-- <ul class="page-breadcrumb">
    <li>
        <i class="fa fa-home"></i>
        <a href="http://127.0.0.1:8000/">Dashboard</a>
        <i class="fa fa-angle-right"></i>
    </li>

    <li>
        <a href="http://127.0.0.1:8000/menu/kejuruan">PELATIHAN PESERTA</a>
        <i class="fa fa-angle-right"></i>
    </li>
</ul> --}}
@endsection

@section('contents')
<div class="container">
    <div class="d-flex justify-content-between mb-2">
        <h2>Daftar Peserta Dari </h2>
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
                <th>Nama Peserta</th>
                <th>Email</th>
                <th>Status</th>
                <th>Minat</th>
                <th>Daftar Ulang</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody id="myTable">
            @foreach($data as $d)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $d->user->nama_depan }} {{ $d->user->nama_belakang }}</td>
                <td>{{ $d->email_peserta }}</td>
                <td>{{ $d->status }}</td>
                <td>{{ $d->is_sesuai_minat == 1 ? 'Ya' : $d->is_sesuai_minat == 0 ? 'Belum Mengisi' : 'Tidak' }}</td>
                <td>{{ $d->is_daftar_ulang == 1 ? 'Ya' : 'Tidak'  }}</td>
                <td>
                    <a data-toggle="modal" data-target="#modalEditPelatihanPeserta" class='btn btn-warning'
                        onclick="modalEdit({{$d->sesi_pelatihans_id}})">
                        Update Hasil Seleksi
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="modalEditPelatihanPeserta" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" id="modalContent">

    </div>
</div>

@endsection
