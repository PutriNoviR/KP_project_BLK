@extends('layouts.adminlte')

@section('title')
PELATIHAN
@endsection

@section('page-bar')

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
        <h2>Daftar Sesi Pelatihan</h2>
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
                <th>BLK</th>
                <th>Kejuruan</th>
                <th>Sub Kejuruan</th>
                <th>Tanggal Buka Pendaftaran</th>
                <th>Tanggal Tutup Pendaftaran</th>
                <th>Lokasi</th>
                <th>Kuota</th>
                <th>Tanggal Seleksi</th>
                <th>Aktivitas</th>

                <th>Aksi</th>
            </tr>
        </thead>
        <tbody id="myTable">
            @foreach($data as $d)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $d->paketprogram->blk->nama }}</td>
                <td>{{ $d->paketprogram->kejuruan->nama }}</td>
                <td>{{ $d->paketprogram->subk->nama }}</td>
                <td>{{ $d->tanggal_pendaftaran }}</td>
                <td>{{ $d->tanggal_tutup }}</td>
                <td>{{ $d->lokasi }}</td>
                <td>{{ $d->kuota }}</td>
                <td>{{ $d->tanggal_seleksi }}</td>
                <td>{{ $d->aktivitas }}</td>
                <td>
                    <a data-toggle="modal" data-target="#modalEditBlk" class='btn btn-warning'
                        onclick="modalEdit({{$d->id}})">
                        <i class="fas fa-pen"></i>
                    </a>
                    <form method="POST" action="{{ route('blk.destroy',$d->id) }}"
                        onsubmit="return submitFormDelete(this);" class="d-inline">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger" data-toggle="modal"
                            href="{{route('blk.show',$d->id)}}" data-toggle="modal"><i
                                class="fas fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
