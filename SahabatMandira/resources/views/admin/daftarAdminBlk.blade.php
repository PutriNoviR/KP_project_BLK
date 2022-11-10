@extends('layouts.adminlte')

@section('title')
Admin BLK
@endsection

@section('javascript')
<script>
    $(function () {
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
            url: '{{ route("super.adminblk.getEditForm") }}',
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'email': email,
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

</script>
@endsection

@section('contents')
<div class="container">
    <div class="d-flex justify-content-between mb-2">
        <h2>Daftar Admin BLK</h2>
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">
            Tambah Admin BLK Baru
        </button>
    </div>
    @if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
    @elseif (\Session::has('failed'))
    <div class="alert alert-danger">
        <ul>
            <li>{!! \Session::get('failed') !!}</li>
        </ul>
    </div>
    @endif
    <table class="table table-striped table-bordered table-hover dataTable no-footer" id="myTable" role="grid"
        aria-describedby="sample_1_info">
        <thead>
            <tr role="row">
                <th>BLK</th>
                <th>Nama Depan</th>
                <th>Nama Belakang</th>
                <th>Nomor HP</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody id="myTable">
            @foreach($adminblks as $d)
            <tr>
                <td>{{ $d->blk->nama }}</td>
                <td>{{ $d->nama_depan }}</td>
                <td>{{ $d->nama_belakang }}</td>
                <td>{{ $d->nomer_hp }}</td>
                <td>
                    <a data-toggle="modal" data-target="#modalEditAdminBlk" class='btn btn-warning'
                        onclick="modalEdit('{{$d->email}}')">
                        <i class="fas fa-pen"></i>
                    </a>
                    <form method="POST" action="{{ route('super.adminblk.destroy',$d->email) }}"
                        onsubmit="return submitFormDelete(this);" class="d-inline">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger" data-toggle="modal" data-toggle="modal"><i
                                class="fas fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="modalEditAdminBlk" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" id="modalContent">

    </div>
</div>

<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Admin BLK</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <form method="POST" action="{{ route('super.adminblk.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="nama" class="col-md-12 col-form-label">{{ __('BLK') }}</label>

                            <div class="col-md-12">
                                <select name="blks_id" class="form-control">
                                    @foreach ($blks as $blk)
                                    <option value="{{ $blk->id }}">
                                        {{ $blk->nama }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-md-12 col-form-label">{{ __('Email') }}</label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control" name="email" required
                                    autocomplete="email" autofocus>

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
