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
                <th>WEBSITE</th>
                <th>is_punyasistem</th>
                <th>Link Pendaftaran</th>
            </tr>
        </thead>
        <tbody id="myTable">
            <tr>
                <td>{{ $blk->id }}</td>
                <td>{{ $blk->nama }}</td>
                <td>{{ $blk->alamat }}</td>
                <td>{{ $blk->website_portfolio }}</td>
                <td>{{ $blk->is_punyasistem }}</td>
                <td>{{ $blk->link_pendaftaran }}</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
