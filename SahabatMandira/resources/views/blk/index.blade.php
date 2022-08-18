@extends('layouts.adminlte')

@section('title')
BLK
@endsection



@section('javascript')
<script>
    $(function () {
        $("#example2").DataTable({
            "responsive": true,
            "autoWidth": false,
        });
    });

    function modalEdit(blkId) {
        $.ajax({
            type: 'POST',
            url: '{{ route("blk.getEditForm") }}',
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'id': blkId,
            },
            success: function (data) {
                $("#modalContent").html(data.msg);
            },
            error: function (xhr) {
                console.log(xhr);
            }
        });
    }

    function submitFormDelete(form) {
        console.log('oi');
        swal({
                title: "Peringatan!",
                text: "Apakah anda yakin ingin menghapus data ini?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    form.submit();
                }
            });
        return false;
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
    <div class="d-flex justify-content-between mb-2">
        <h2>Daftar Program BLK</h2>
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">
            Tambah BLK Baru
        </button>
    </div>
    @if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
    @endif
    <table class="table table-striped table-bordered table-hover dataTable no-footer" id="example2" role="grid"
        aria-describedby="sample_1_info">
        <thead>
            <tr role="row">
                <th>No</th>
                <th>Nama Balai Latihan Kerja</th>
                <th>Alamat</th>
                <th>Website Portfolio</th>
                <th>Memiliki Sistem</th>
                <th>Link Pendaftaran</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody id="myTable">
            @foreach($data as $d)
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
                    <form method="POST" action="{{ route('blk.destroy',$d->id) }}"
                        onsubmit="return submitFormDelete(this);" class="d-inline">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger" data-toggle="modal"
                            href="{{route('blk.show',$d->id)}}" data-toggle="modal"><i
                                class="fas fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="modalEditBlk" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" id="modalContent">

    </div>
</div>

<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah BLK</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <form method="POST" action="{{ route('blk.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="nama"
                                class="col-md-12 col-form-label">{{ __('Nama Balai Latihan Kerja') }}</label>

                            <div class="col-md-12">
                                <input id="nama" type="nama" class="form-control @error('email') is-invalid @enderror"
                                    name="nama" value="{{ old('nama') }}" required autocomplete="nama" autofocus>

                                @error('nama')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="alamat" class="col-md-12 col-form-label">{{ __('Alamat') }}</label>

                            <div class="col-md-12">
                                <input id="alamat" type="text"
                                    class="form-control @error('alamat') is-invalid @enderror" name="alamat"
                                    value="{{ old('alamat') }}" required autocomplete="alamat" autofocus>

                                @error('alamat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="website" class="col-md-12 col-form-label">{{ __('Website Portofolio') }}</label>

                            <div class="col-md-12">
                                <input id="website" type="text"
                                    class="form-control @error('website') is-invalid @enderror" name="website_portfolio"
                                    value="{{ old('website') }}" required autocomplete="website" autofocus>

                                @error('website')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="memilikiSistem"
                                class="col-md-12 col-form-label">{{ __('Memiliki Sistem') }}</label>

                            <div class="col-md-12">
                                <select class="form-control" aria-label="Default select example" name="is_punyasistem">
                                    <option value="1">YA</option>
                                    <option value="0">Tidak</option>
                                </select>

                                @error('memilikiSistem')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="linkPendaftaran"
                                class="col-md-12 col-form-label">{{ __('Link Pendaftaran') }}</label>

                            <div class="col-md-12">
                                <input id="linkPendaftaran" type="text"
                                    class="form-control @error('linkPendaftaran') is-invalid @enderror"
                                    name="link_pendaftaran" value="{{ old('linkPendaftaran') }}" required
                                    autocomplete="linkPendaftaran" autofocus>

                                @error('linkPendaftaran')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">SIMPAN</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        @endsection
