@extends('layouts.index')

@section('title')
BLK
@endsection

@section('javascript')
<script>
    function getEditForm(myid) {
        $.ajax({
            type: 'POST',
            url: '{{ route("blk.getEditForm")}}',
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'id': myid
            },
            success: function(data) {
                // alert(data.msg);
                $('#modalContent').html(data.msg)
            }
        });
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
        <a href="http://127.0.0.1:8000/menu/kejuruan">BLK</a>
        <i class="fa fa-angle-right"></i>
    </li>
</ul> --}}
@endsection
@section('contents')
<div class="container">
    <h2>Daftar Program BLK</h2>
    <div class="input-group">
        <input class="form-control" id="myInput" type="text" placeholder="Search..">
        <br>
    </div>
    <table class="table table-striped table-bordered table-hover dataTable no-footer" id="sample_1" role="grid" aria-describedby="sample_1_info">
        <thead>
            <tr role="row">
                <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending" style="width: 129px;">ID</th>
                <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending" style="width: 129px;">NAMA BLK</th>
                <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending" style="width: 129px;">ALAMAT BLK</th>
                <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending" style="width: 129px;">DETAIL</th>
                <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending" style="width: 129px;">Aksi</th>
            </tr>
        </thead>
        <tbody id="myTable">
            @foreach($data as $d)
            <tr>
                <td>{{ $d->id }}</td>
                <td>{{ $d->nama }}</td>
                <td>{{ $d->alamat }}</td>
                <td>
                    <a class="btn btn-primary" data-toggle="modal" href="{{route('blk.show',$d->id)}}" data-toggle="modal">Detail</a>
                </td>
                <td>
                    <!-- <a class="btn btn-primary" data-toggle="modal" href="{{route('blk.edit',$d->id)}}" data-toggle="modal">Edit</a> -->
                    <a href="#modalEdit" data-toggle='modal' class='btn btn-warning btn-xs' onclick="getEditForm('{{$d->id}}')">
                        Edit
                    </a>
                    

                    <a class="btn btn-primary" data-toggle="modal" href="{{route('blk.show',$d->id)}}" data-toggle="modal">Delete</a>
                </td>
            </tr>
            @endforeach
            <div class="modal fade" id="modalEdit" tabindex="-1" role="basic" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content" id='modalContent'></div>
                        </div>
                    </div>
        </tbody>
    </table>
</div>
@endsection