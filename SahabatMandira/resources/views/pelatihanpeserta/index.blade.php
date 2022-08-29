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

    function modalEdit(id) {
        $.ajax({
            type: 'POST',
            url: '{{ route("pelatihanPesertas.getEditForm") }}',
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'email_peserta': id,
            },
            success: function (data) {
                $("#modalContent").html(data.msg);
            },
            error: function (xhr) {
                console.log(xhr);
            }
        });
    }

    function alertShow($id) {
        $.ajax({
            type: 'POST',
            url: '',
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'id': $id,
            },
            success: function (data) {
                swal({
                    title: "Rekomendasi",
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


@section('page-bar')

@endsection

@section('contents')
<div class="container">
    <div class="d-flex justify-content-between mb-2">
        @foreach($periode as $d)
        <h2>Daftar Peserta Dari {{ date('M y', strtotime($d->tanggal_pendaftaran)) }} -
            {{ date('M y', strtotime($d->tanggal_tutup)) }} </h2>
        @endforeach
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
                <th>Rekomendasi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody id="myTable">
            @foreach($data as $d)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $d->nama_depan }} {{ $d->nama_belakang }}</td>
                <td>{{ $d->email_peserta }}</td>
                <td>{{ $d->status }}</td>
                @if( $d->is_sesuai_minat == 1 )
                <td> Ya </td>
                @elseif( $d->is_sesuai_minat == 0 )
                <td> Belum Mengisi </td>
                @elseif( $d->is_sesuai_minat == -1)
                <td> Tidak </td>
                @endif
                <td>{{ $d->is_daftar_ulang == 1 ? 'Ya' : 'Tidak'  }}</td>
                <td>
                    <button class='btn btn-info' onclick="alertShow({{$d->sesi_pelatihans_id}})">
                        <i class="fas fa-eye"></i>
                    </button>
                </td>
                <td>
                    <button data-toggle="modal" data-target="#modalEditPelatihanPeserta" class='btn btn-warning'
                        onclick="modalEdit('{{$d->email_peserta}}')"
                        {{ $d->rekom_is_permanent == 1 ? 'disabled' : '' }}>
                        Update Hasil Seleksi
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="modalEditPelatihanPeserta" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true" name="sesi_pelatihans_id" value="{{$d->sesi_pelatihans_id}}">
    <div class="modal-dialog" id="modalContent">

    </div>
</div>

@endsection
