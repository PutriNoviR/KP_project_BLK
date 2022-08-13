@extends('layouts.index')

@section('title')
BLK
@endsection

@section('page-bar')
<ul class="page-breadcrumb">
    <li>
        <i class="fa fa-home"></i>
        <a href="http://127.0.0.1:8000/">Dashboard</a>
        <i class="fa fa-angle-right"></i>
    </li>

    <li>
        <a href="http://127.0.0.1:8000/menu/kejuruan">BLK</a>
        <i class="fa fa-angle-right"></i>
    </li>
</ul>
@endsection

@section('contents')
<div class="container">
    <h2>Daftar Program BLK</h2>
    <div class="input-group">
        <input class="form-control" id="myInput" type="text" placeholder="Search..">
        <br>
    </div>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>NAMA BLK</th>
                <th>ALAMAT BLK</th>
                <th>DETAIL</th>
            </tr>
        </thead>
        <tbody id="myTable">
            @foreach($data as $d)
            <tr>
                <td>{{ $d->id }}</td>
                <td>{{ $d->nama }}</td>
                <td>{{ $d->alamat }}</td>
                <td>
                    <a class="btn btn-primary" data-toggle="modal" href="{{route('blk.show',$d->id)}}"
                        data-toggle="modal">detail</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
