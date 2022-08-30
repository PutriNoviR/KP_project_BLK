@extends('layouts.adminlte')

@section('javascript')
<script>
    $(function () {
        $("#myTable").DataTable({
            "responsive": true,
            "autoWidth": false,
        });
    });

    function modalEditPelamar(lowonganId, userEmail) {
        $.ajax({
            type: 'POST',
            url: '{{ route("lamaran.getEditForm") }}',
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'lowongans_id': lowonganId,
                'users_email': userEmail,
            },
            success: function (data) {
                $("#modalContent").html(data.msg);
            },
            error: function (xhr) {
                console.log(xhr);
            }
        });
    }

</script>
@endsection

@section('contents')
<div class="container">
    @if (\Session::has('success'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        {!! \Session::get('success') !!}
    </div>
    @endif
    <table class="table table-striped table-bordered table-hover dataTable no-footer" id="myTable" role="grid"
        aria-describedby="sample_1_info">
        <thead>
            <tr role="row">
                <th>Nama</th>
                <th>Tanggal Melamar</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody id="myTable">
            @php
            $i =0;
            @endphp
            @foreach($lamarans as $pelamar)
            <tr>
                <td>{{ $users[$i]->nama_depan }} {{  $users[$i]->nama_belakang }}</td>
                <td>{{ $pelamar->tanggal_pelamaran }}</td>
                <td>{{ $pelamar->status }}</td>
                <td>
                    <a data-toggle="modal" data-target="#modalEditPelamar" class='btn btn-warning'
                        onclick="modalEditPelamar({{$pelamar->lowongans_id}},'{{ $pelamar->users_email }}')">
                        <i class="fas fa-pen"></i>
                    </a>
                    <form method="POST" action="{{ route('lamaran.destroy',$pelamar->lowongans_id) }}"
                        onsubmit="return submitFormDelete(this);" class="d-inline">
                        @method('DELETE')
                        @csrf
                        <input type="hidden" value="{{ $users[$i]->email }}" name="users_email">
                        <button type="submit" class="btn btn-danger" data-toggle="modal" data-toggle="modal"><i
                                class="fas fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            @php
            $i++;
            @endphp
            @endforeach
        </tbody>
    </table>
</div>
{{-- Modal --}}
<div class="modal fade" id="modalEditPelamar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" id="modalContent">

    </div>
</div>
@endsection
