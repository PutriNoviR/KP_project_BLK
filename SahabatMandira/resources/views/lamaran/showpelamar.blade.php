@extends('layouts.adminlte')

@section('contents')
<table class="table table-striped table-bordered table-hover dataTable no-footer" id="myTable" role="grid"
    aria-describedby="sample_1_info">
    <thead>
        <tr role="row">
            <th>Nama</th>
            <th>Status</th>
            <th></th>
        </tr>
    </thead>
    <tbody id="myTable">
        @foreach($lamarans as $pelamar)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $d->nama }}</td>
            <td>{{ $d->alamat }}</td>
            <td>{{ $d->website_portfolio }}</td>
            <td>{{ $d->is_punyasistem == 1 ? 'Ya' : 'Tidak' }}</td>
            <td>{{ $d->link_pendaftaran }}</td>
            <td>
                <a data-toggle="modal" data-target="#modalEditBlk" class='btn btn-warning'
                    onclick="modalEdit({{$d->id}})">
                    <i class="fas fa-pen"></i>
                </a>
                <form method="POST" action="{{ route('blk.destroy',$d->id) }}" onsubmit="return submitFormDelete(this);"
                    class="d-inline">
                    @method('DELETE')
                    @csrf

                    <button type="submit" class="btn btn-danger" data-toggle="modal" data-toggle="modal"><i
                            class="fas fa-trash"></i></button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
