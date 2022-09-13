@extends('layouts.adminlte')

@section('title')
Daftar Peserta
@endsection

@section('page-bar')
{{-- <ul class="page-breadcrumb">
    <li>
        <i class="fa fa-home"></i>
        <a href="http://127.0.0.1:8000/">Dashboard</a>
        <i class="fa fa-angle-right"></i>
    </li>

    <li>
        <a href="http://127.0.0.1:8000/menu/user">User</a>
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
            url: '{{ route("user.getEditForm") }}',
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

    function submitFormSuspend(form) {
        swal({
                title: "Peringatan!",
                text: "Apakah anda yakin ingin mengsuspend peserta ini?",
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
        <h2>Daftar Peserta</h2>
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">
            Tambah User Baru
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
                <th>NO</th>
                <th>EMAIL</th>
                <th>USERNAME</th>
                <th>NAMA</th>
                <th>AKSI</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $d)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $d->email}}</td>
                <td>{{ $d->username}}</td>
                <td>{{ $d->nama_depan}} {{ $d->nama_belakang}}</td>
                <td>
                    @if( $d->is_suspend == '1')
                    <button data-toggle="modal" onclick="return submitFormSuspend(this);"
                        data-target="#modalEditPelatihanPeserta" class='btn btn-success'
                        onclick="modalEdit('{{$d->email_peserta}}')">
                        UNSUSPEND
                    </button>
                    @else
                    <button data-toggle="modal" onclick="return submitFormSuspend(this);"
                        data-target="#modalEditPelatihanPeserta" class='btn btn-danger'
                        onclick="modalEdit('{{$d->email_peserta}}')">
                        SUSPEND
                    </button>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
