@extends('layouts.index')

@section('title')
Daftar Sub Kejuruan
@endsection

@section('page-bar')
<ul class="page-breadcrumb">
    <li>
        <i class="fa fa-home"></i>
        <a href="http://127.0.0.1:8000/">Dashboard</a>
        <i class="fa fa-angle-right"></i>
    </li>

    <li>
        <a href="http://127.0.0.1:8000/menu/subkejuruan">Sub Kejuruan</a>
        <i class="fa fa-angle-right"></i>
    </li>
</ul>
@endsection



@section('contents')
<div class="container">
    <h2>Daftar Sub Kejuruan</h2>
    <a href="{{url('menu/subkejuruan/create')}}" class="btn btn-info" type="button">
        + Sub Kejuruan Baru
    </a>
    @if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
    @endif
    <div class="input-group">
        <input class="form-control" id="myInput" type="text" placeholder="Search..">
        <br>
    </div>
    <table class="table table-striped table-bordered table-hover dataTable no-footer" id="sample_1" role="grid" aria-describedby="sample_1_info">
        <thead>
            <tr role="row">
                <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending" style="width: 129px;">ID</th>
                <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending" style="width: 129px;">NAMA SUB KEJURUAN</th>
                <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending" style="width: 129px;">DETAIL</th>
            </tr>
        </thead>
        <tbody id="myTable">
            @foreach($data as $d)
            <tr>
                <td>{{ $d->id }}</td>
                <td>{{ $d->nama }}</td>
                <td>
                    <a class="btn btn-primary" data-toggle="modal" href="{{url('/menu/subkejuruan/detail/'.$d->idsub_kejuruans)}}" data-toggle="modal">detail</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function() {
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>
@endsection