@extends('layouts.index')

@section('title')
    Kejuruan
@endsection

@section('page-bar')
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="http://127.0.0.1:8000/">Dashboard</a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <a href="http://127.0.0.1:8000/menu/kejuruan">Kejuruan</a>
            <i class="fa fa-angle-right"></i>
        </li> 
    </ul>
@endsection



@section('contents')
<div class="container">
    <h2>DETAIL PROGRAM PELATIHAN YANG DIBUKA</h2>
    <div class="input-group">
        <input class="form-control" id="myInput" type="text" placeholder="Search..">
        <br>
    </div>
<table class="table table-hover">
    <thead>
    <tr>
        <th>KEJURUAN</th>
        <th>PROGRAM PELATIHAN</th>
        <th>BLK TERKAIT</th>
        <th>PERIODE PENDAFTARAN</th>
        <th>ALAMAT BLK</th>
        <th>STATUS</th>
    </tr>
    </thead>
    <tbody id="myTable">
    @foreach($data as $d)
    <tr>
        <td>{{ $d->kejuruan }}</td>
        <td>{{ $d->program }}</td>
        <td>{{ $d->blk }}</td>
        <td>{{ $d->periode }}</td>
        <td>{{ $d->alamat }}</td>
        <td>
            <input type="submit" value="DAFTAR" class="btn btn-info btn-xs" onclick="if(!confirm('are you sure to delete this record')) return false;">
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
</div>

<script>
$(document).ready(function(){
    $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});
</script> 
@endsection
