@extends('layouts.adminlte')

@section('title')
Daftar Mentor
@endsection

@section('javascript')
<script>
    $(function() {
        $("#myTable").DataTable({
            "responsive": true,
            "autoWidth": false,
            dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'print',
                    {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [0,1,2,3]
                        }
                    },
                    'colvis'
                ]
        });
    });

    function modalEdit(email) {
        $.ajax({
            type: 'POST',
            url: '{{ route("user.getEditForm") }}',
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'email': email,
            },
            success: function(data) {
                $("#modalContent").html(data.msg);
            },
            error: function(xhr) {
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
        <h2>Daftar Mentor</h2>
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
                    <form method="POST" action="{{ route('User.suspend',$d->email) }}" onsubmit="return submitFormSuspend(this);" class="d-inline">
                        @csrf
                        <button data-toggle="modal" data-target="#modalEditPelatihanPeserta" class='btn btn-success' onclick="modalEdit('{{$d->email_peserta}}')">
                            UNSUSPEND
                        </button>
                    </form>
                    @else
                    <form method="POST" action="{{ route('User.suspend',$d->email) }}" onsubmit="return submitFormSuspend(this);" class="d-inline">
                        @csrf
                        <button data-toggle="modal" data-target="#modalEditPelatihanPeserta" class='btn btn-danger' onclick="modalEdit('{{$d->email_peserta}}')">
                            SUSPEND
                        </button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
