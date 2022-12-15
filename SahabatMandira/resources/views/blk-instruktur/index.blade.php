@extends('layouts.adminlte')

@section('title')
BLK - Pengelolaan Instruktur
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
                        columns: [0,1,2]
                        }
                    },
                    'colvis'
                ]
        });
    });

    function modalEdit(blkId) {
        $.ajax({
            type: 'POST',
            url: '{{ route("blk.getEditForm") }}',
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'id': blkId,
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

    $('.instruktur').select2({
        dropdownParent: '#modalTambah',
        width: '100%',
        placeholder: 'Silahkan Pilih Email Instruktur',
        allowClear: true
    });

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
        <a href="http://127.0.0.1:8000/menu/kejuruan">BLK</a>
        <i class="fa fa-angle-right"></i>
    </li>
</ul> --}}
@endsection

@section('contents')
<!-- Modal -->
<div class="modal fade" id="modalEditBlk" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" id="modalContent">

    </div>
</div>

<div class="container">
    <div class="d-flex justify-content-between mb-2">
        <h2>Daftar Instruktur</h2>
        <button class="btn btn-success" data-toggle="modal" data-target="#modalTambah">
            <i class="fas fa-plus-circle"></i> &nbsp;Instruktur Baru
        </button>
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
                <th>Nama Instruktur</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody id="myTable">
            @foreach($data as $d)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $d->username }}</td>
                <td>{{ $d->email }}</td>
                <td>
                    <form method="POST" action="{{ route('blk-inst.destroy',$d->email) }}" onsubmit="return submitFormDelete(this);" class="d-inline">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger" data-toggle="modal" data-toggle="modal"><i
                                class="fas fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="modalEditBlk" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" id="modalContent">

    </div>
</div>

<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambahkan Instruktur</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <form method="POST" action="{{ route('blk-inst.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="memilikiSistem" class="col-md-12 col-form-label">{{ __('Email Instruktur') }}</label>

                            <div class="col-md-12">
                                <select class="form-control instruktur" aria-label="Default select example" name="email">
                                    <option></option>
                                    @foreach ($instruktur as $i)
                                        <option value="{{$i->email}}">{{ $i->email }}</option>
                                    @endforeach
                                </select>

                                @error('memilikiSistem')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">TUTUP</button>
                            <button type="submit" class="btn btn-primary">SIMPAN</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
