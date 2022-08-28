@extends('layouts.adminlte')

@section('title')
Pelatihan
@endsection

@section('javascript')
<script>
    $(function () {
        $("#myTable").DataTable({
            "responsive": true,
            "autoWidth": false,
        });
    });

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

@section('page-bar')

@endsection

@section('contents')

<div class="container">
    <div class="d-flex justify-content-between mb-2">
        <h2>Pelatihan Yang Pernah Diikuti</h2>
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
                <th>Nama Balai Latihan Kerja</th>
                <th>Kejuruan</th>
                <th>Sub Kejuruan</th>
                <th>Periode</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody id="myTable">
            @foreach($data as $d)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $d->nama }}</td>
                <td>{{ $d->kejuruan }}</td>
                <td>{{ $d->sub_kejuruan }}</td>
                <td>{{ $d->periode</td>
                <td>{{ $d->status}}</td> {{-- lulus / tidak lulus--}}
                <td>
                    <a data-toggle="modal" data-target="" class='btn btn-warning'>
                        Daftar Ulang
                    </a> {{-- kalau lolos di enable kalo ga lolos disable--}}
                    <a data-toggle="modal" data-target="" class='btn btn-warning'>
                        Download Sertifikat
                    </a> {{-- kalau lolos di enable kalo ga lolos disable--}}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
