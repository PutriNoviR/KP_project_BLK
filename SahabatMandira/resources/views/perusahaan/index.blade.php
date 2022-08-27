@extends('layouts.adminlte')

@section('title')
Perusahaan
@endsection

@section('javascript')
<script>
    $(function () {
        $("#myTable").DataTable({
            "responsive": true,
            "autoWidth": false,
        });
    });

    function modalEditForm(perusahaanId) {
        $.ajax({
            type: 'POST',
            url: '{{ route("perusahaan.getEdit") }}',
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'id': perusahaanId,
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

@section('page-bar')
{{-- <ul class="page-breadcrumb">
    <li>
        <i class="fa fa-home"></i>
        <a href="http://127.0.0.1:8000/">Dashboard</a>
        <i class="fa fa-angle-right"></i>
    </li>

    <li>
        <a href="">Perusahaan</a>
        <i class="fa fa-angle-right"></i>
    </li>
</ul> --}}
@endsection

@section('contents')
<!-- Modal -->
<div class="modal fade" id="modalEditPerusahaan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" id="modalContent">

    </div>
</div>

<div class="container">
    <div class="d-flex justify-content-between mb-2">
        <h2>Daftar Perusahaan</h2>
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">
            Tambah Perusahaan
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
                <th>Nama Perusahaan</th>
                <th>Bidang</th>
                <th>Alamat</th>
                <th>Kode Pos</th>
                <th>Nomor Telepon</th>
                <th>Email</th>
                <th>SIUP</th>
                <th>NPWP</th>
                <th>Logo</th>
                <th>Foto</th>
                <th>Tentang</th>
            </tr>
        </thead>
        <tbody id="myTable">
            @foreach($data as $d)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $d->nama }}</td>
                <td>{{ $d->bidang }}</td>
                <td>{{ $d->alamat }}</td>
                <td>{{ $d->kode_pos }}</td>
                <td>{{ $d->no_telp }}</td>
                <td>{{ $d->email }}</td>
                <td>{{ $d->siup }}</td>
                <td>{{ $d->npwp }}</td>
                <td>{{ $d->logo }}</td>
                <td>{{ $d->images }}</td>
                <td>
                    <a data-toggle="modal" data-target="#modalEditPerusahaan" class='btn btn-warning'
                        onclick="modalEdit({{$d->id}})">
                        <i class="fas fa-pen"></i>
                    </a>
                    <form method="POST" action="{{ route('perusahaan.destroy',$d->id) }}"
                        onsubmit="return submitDelete(this);" class="d-inline">
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
<div class="modal fade" id="modalEditPerusahaan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" id="modalContent">

    </div>
</div>
@endsection
