@extends('layouts.adminlte')

@section('title')
Daftar Peserta Diterima
@endsection
@section('javascript')
<script>
    $(function() {
        var table = $("#myTable").DataTable({
            "responsive": true,
            "autoWidth": false,
            columnDefs: [{
                    orderable: false,
                    className: 'select-checkbox',
                    targets: 0,
                },
                {
                    target: 2,
                    visible: false,
                    searchable: false,
                }

            ],
            select: {
                style: 'multi',
                selector: 'td:first-child'
            },
            order: [
                [1, 'asc']
            ],
            
            dom: 'Bflrtip'
        });

        $(".selectAll").on("click", function(e) {
            if ($(this).is(":checked")) {
                table.rows().select();
            } else {
                table.rows().deselect();
            }
        });
    });


    function modalEdit(email, id) {
        $.ajax({
            type: 'POST',
            url: '{{ route("pelatihanPesertas.getEditForm") }}',
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'email_peserta': email,
                'sesi_pelatihans_id': id
            },
            success: function(data) {
                $("#modalContent").html(data.msg);
            },
            error: function(xhr) {
                console.log(xhr);
            }
        });
    }

    function modalKompetensi(email, id) {
        $.ajax({
            type: 'POST',
            url: '{{ route("pelatihanPesertas.getKompetensiForm") }}',
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'email_peserta': email,
                'sesi_pelatihans_id': id
            },
            success: function(data) {
                $("#modalContent2").html(data.msg);
            },
            error: function(xhr) {
                console.log(xhr);
            }
        });
    }

    function alertShow($id) {
        $.ajax({
            type: 'POST',
            url: '{{ route("pelatihanPeserta.getDetail") }}',
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'id': $id,
            },
            success: function(data) {
                swal({
                    title: "Rekomendasi",
                    text: data.data,
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
<div class="container">
    <div class="d-flex justify-content-between mb-2">
    <h1 class="mx-auto" style="font-size: 50px; color: #3498db; text-align: center; font-weight: bold; margin-top: 20px;">
        Daftar Peserta Diterima
    </h1>

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
    <table class="table table-striped table-bordered table-hover dataTable no-footer" id="myTable" role="grid" aria-describedby="sample_1_info">
        <thead>
            <tr role="row">
                <th><input type="checkbox" class="selectAll" id="selectAll"> <label for="selectAll">Select All</label></th>
                <th>No</th>
                <th>Email</th>
                <th>Nama Peserta</th>
                <th>Profil Peserta</th>
                <th>Status</th>
                <th>BLK</th>
                <th>Pelatihan yang Diikuti</th>
            </tr>
        </thead>
        <tbody id="myTable">
            @foreach($data as $d)
            <tr>
                <td></td>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $d->email }}</td>
                <td>{{ $d->nama }}</td>
                <td class="text-center">
                    <a data-toggle="modal" data-target="#modalInfoPeserta{{$d->username}}" class="btn btn-info">
                        <i class="fas fa-info-circle"></i>
                    </a>
                </td>
                <td>{{ $d->status }}</td>
                <td>
                    {{ $d->blk }}  
                </td>
                <td>
                    {{ $d->sub_kejuruan }}
                </td>
                @if(Auth::user()->role->nama_role == 'superadmin' || Auth::user()->role->nama_role == 'adminblk')
                <td>
                    <form method="POST" action="{{ route('sesiPelatihan.daftarulang') }}" class="d-inline">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" name="sesi_pelatihans_id" class="col-md-12 col-form-label" value="{{$d->sesi_pelatihans_id}}">
                            <input type="hidden" name="email" class="col-md-12 col-form-label" value="{{$d->email_peserta}}">
                            <button data-toggle="modal" data-target="" class='btn btn-success' {{ $d->is_daftar_ulang  == '1' ? 'disabled' : ''}}>
                                Daftar Ulangkan
                            </button>
                        </div>
                    </form>
                </td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection