@extends('layouts.adminlte')

@section('title')
Assign Tugas
@endsection

@section('javascript')
<script>
    $(function() {
        $("#myTable").DataTable({
            "responsive": true,
            "autoWidth": false,
        });
    });
    
    function alertShow(id) {
        $.ajax({
            type: 'POST',
            url: '{{ route("tugas.getDetail") }}',
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'id': id,
            },
            success: function(data) {
                Swal.fire({
                    title: "Bukti",
                    imageUrl: 'http://localhost:8000/storage/'+ data.data +'',
                    imageHeight: 800,
                    imageWidth: 1300,
                    width: 1300,
                })
            },
            error: function(xhr) {
                console.log(xhr);
            }
        });
    }
</script>
@endsection

@section('page-bar')
@endsection

@section('contents')

@if(Auth::user()->role->nama_role == 'adminblk' || Auth::user()->role->nama_role == 'superadmin')
{{-- MODAL UNTUK RIWAYAT PENUGASAN ADMIN --}}
<div class="container">
    <div class="d-flex justify-content-between mb-2">
        <h2>History Penugasan</h2>
    </div>
    <table class="table table-striped table-bordered table-hover dataTable no-footer" id="myTable" role="grid" aria-describedby="sample_1_info">
        <thead>
            <tr role="row">
                <th>No</th>
                <th>Email Admin</th>
                <th>Email Mentor</th>
                <th>Keterangan</th>
                <th>Bukti Penugasan</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody id="myTable">
            @foreach($data as $d)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $d->email_admin }}</td>
                <td>{{ $d->email_mentor }}</td>
                <td>{{ $d->keterangan }}</td>
                <td>
                    <button class='btn btn-info' onclick="alertShow({{$d->id}})">
                        <i class="fas fa-eye"></i>
                    </button>
                </td>
                <td>{{ $d->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif
@endsection