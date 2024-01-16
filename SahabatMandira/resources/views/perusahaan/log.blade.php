@extends('layouts.adminlte')

@section('title')
    Log Perusahaan
@endsection

@section('javascript')
    <script>

        $(function() {
            $("#myTable").DataTable({
                "responsive": true,
                "autoWidth": false,   
            });
        });

    </script>
@endsection

@section('contents')
    <div class="container">
        <div class="d-flex justify-content-between mb-2">
            <h2>Log Perusahaan</h2>
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
                    {{-- <th>ID</th> --}}
                    <th>Tanggal</th>
                    <th>Email Perusahaan</th>
                    <th>Aksi</th>
                    <th>Keterangan</th>
                    
                    
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $d)
                    <tr>
                        {{-- <td>{{ $d->id }}</td> --}}
                        <td>
                            {{ $d->created_at }}
                        </td>
                        <td>{{ $d->users_email }}</td>
                        <td>{{ $d->aksi }}</td>
                        <td>{{ $d->keterangan }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
