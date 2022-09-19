@extends('layouts.adminlte')

@section('title')
Daftar Program Mentor
@endsection

@section('javascript')
<script>
    $(function() {
        $("#myTable").DataTable({
            "responsive": true,
            "autoWidth": false,
        });
    });

    function submitFormValidated(form) {
        swal({
                title: "Peringatan!",
                text: "Apakah anda yakin ingin mengvalidasi peserta ini?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willValidated) => {
                if (willValidated) {
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
        <h2>Daftar Program Mentor</h2>
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
                <th>Nama Program</th>
                <th>Deskripsi</th>
                <th>Periode</th>
                <th>Link Pendaftaran</th>
                <th>AKSI</th>
            </tr>
        </thead>
        <tbody>
            @foreach($mentoring as $m)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $m->nama_program}}</td>
                <td>{{ $m->deskripsi_program}}</td>
                <td>{{ $m->tgl_dibuka}} - {{ $m->tgl_ditutup}}</td>
                <td>{{ $m->link_pendaftaran}}</td>
                <td>
                    <form method="POST" action="{{ route('mandiraMentoring.validated',$m->id_mentoring) }}" onsubmit="return submitFormValidated(this);" class="d-inline">
                        @csrf
                        <button data-toggle="modal" data-target="#modalEditPelatihanPeserta" class='btn btn-warning' onclick="modalEdit('{{$m->id_mentoring}}')">
                            VALIDATED
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection