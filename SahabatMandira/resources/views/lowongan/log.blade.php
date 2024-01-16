@extends('layouts.adminlte')

@section('title')
    Log Lowongan
@endsection

@section('javascript')
    <script>
        $(function() {
            $("#myTable").DataTable({
                "responsive": true,
                "autoWidth": false,
                order: [
                    [1, 'desc']
                ]
            });
        });
    </script>
@endsection

@section('contents')
    <h2>Daftar Log Lowongan {{ $lowongan->nama }} </h2>

    <table class="table table-striped table-bordered table-hover dataTable no-footer" id="myTable" role="grid"
        aria-describedby="sample_1_info">
        <thead>
            <tr role="row">
                <th>Tanggal Update</th>
                <th>Email Pelamar</th>
                <th>Aksi</th>
                <th>Email Perusahaan</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody id="myTable">
            @foreach ($showLog as $log)
                @php
                    $explode = explode('user -', $log->keterangan);
                    $getEmail = explode(' ', $explode[1]) ;
                    $status = explode('menjadi', $explode[1])
                @endphp
                
                <tr>
                    <td>{{ $log->updated_at }}</td>
                    <td>{{ $getEmail[1] }}</td>
                    <td>{{ explode('lowongan', $log->aksi)[0] }}</td>
                    <td>{{ $log->users_email }}</td>
                    <td>{{ $status[1] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
