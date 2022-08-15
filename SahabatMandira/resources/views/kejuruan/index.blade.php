@extends('layouts.index')

@section('title')
    Daftar Kejuruan
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
    <h2>DAFTAR KEJURUAN</h2>
    <div class="input-group">
        <input class="form-control" id="myInput" type="text" placeholder="Search..">
        <br>
    </div>
<table class="table table-hover">
    <thead>
    <tr>
        <th>ID</th>
        <th>NAMA KEJURUAN</th>
        <th>Link</th>
    </tr>
    </thead>
    <tbody id="myTable">
    @foreach($data as $d)
    <tr>
        <td>{{ $d->id }}</td>
        <td>{{ $d->nama }}</td>
        <td><a href="{{ $d->link_kejuruan_test_2 }}">LINK</a></td>
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
