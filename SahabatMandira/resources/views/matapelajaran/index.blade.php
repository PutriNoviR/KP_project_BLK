@extends('layouts.adminlte')
@section('title')
DAFTAR MATA PELAJARAN LINK TOMBOLNYA BUAT KESINI MASIH SALAH
@endsection


@section('javascript')
<script>
    function submitFormDelete(form) {
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

@section('contents')


<div class="container">

    <a data-toggle="modal" data-target="#modalTambahMataPelajaran" class="button btn btn-outline-primary float-right">
        {{ __('TAMBAH MATA PELAJARAN') }}
    </a>
    @if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
    @endif
    @if (\Session::has('error'))
    <div class="alert alert-danger">
        <ul>
            <li>{!! \Session::get('error') !!}</li>
        </ul>
    </div>
    @endif
    <div class="col-sm-6">
        <h4 class="m-0 text-dark">DAFTAR MATA PELAJARAN</h4><br>
        <!-- <h6>Berikut adalah overview dari mata pelajaran yang akan di pelajari</h6> -->
    </div>

    <table class="table table-striped table-bordered table-hover dataTable no-footer" id="myTable" role="grid" aria-describedby="sample_1_info">
        <thead>
            <tr role="row">
                <th>No</th>

                <th>Mata Pelajaran</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($mataPelajaran as $mapel)
            <tr>

                <td>{{ $loop->iteration }}</td>
                <td>{{ $mapel->nama}}</td> {{-- yang ada ->ambil dari function yang ada di modelnya --}}

                {{--<th>Mata Pelajaran</th>--}}
                <td>
                    <a data-toggle="modal" data-target="#modalEditMataPelajaran{{$mapel->id}}" class='btn btn-primary text-white'>
                        &nbsp; EDIT
                    </a>
                    <form method="POST" action="{{ route('mataPelajaran.destroy',$mapel->id) }}" onsubmit="return submitFormDelete(this);" class="d-inline">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger" data-toggle="modal" href="" data-toggle="modal"><i class="fas fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>

            {{-- MODAL EDIT MATA PELAJARAN --}}
            <div class="modal fade" id="modalEditMataPelajaran{{$mapel->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Mata Pelajaran</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{route('mataPelajaran.update',['mataPelajaran'=>$mapel->id])}}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                {{-- <div class="form-group">
                        <label for="nama" class="col-md-12 col-form-label">{{ __('Nama Sub Kejuruan') }}</label>
                                <div class="col-md-12">
                                    <select class="blk-select2 form-control" aria-label="Default select example" name="">
                                        <option>Pilih Sub Kejuruan</option>
                                        @foreach($hasil as $d)
                                        <option value="{{$d->id}}">
                                            {{$d->nama}}
                                        </option>
                                        untuk melakukan pengecekan seperti if apakah id blk yang ada di paket program sama dengan id blk yang ada di foreach ?
                                        @endforeach
                                    </select>
                                </div>
                        </div> --}}

                        <div class="form-group">
                            <label for="nama" class="col-md-12 col-form-label">{{ __('Nama Mata Pelajaran') }}</label>
                            <input type="text" class="col-md-12 col-form-label" name="nama" required value="{{$mapel->nama}}">
                        </div>
                        <div class="form-group">
                            <label for="fotoMataPelajaran" class="col-md-12 col-form-label">{{ __('Foto Mata Pelajaran') }}</label>
                            <input type="file" name='fotoMataPelajaran' class="defaults" accept="image/png, image/gif, image/jpeg" required>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>


            {{-- MODAL DELETE MATA PELAJARAN --}}


            @endforeach
        </tbody>
    </table>
</div>


{{-- MODAL TAMBAH MATA PELAJARAN --}}

<div class="modal fade" id="modalTambahMataPelajaran" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Mata Pelajaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{route('mataPelajaran.store')}}" enctype="multipart/form-data">
                    @csrf
                    {{-- <div class="form-group">
                        <label for="nama" class="col-md-12 col-form-label">{{ __('Nama Sub Kejuruan') }}</label>
                    <div class="col-md-12">
                        <select class="blk-select2 form-control" aria-label="Default select example" name="">
                            <option>Pilih Sub Kejuruan</option>
                            @foreach($hasil as $d)
                            <option value="{{$d->id}}">
                                {{$d->nama}}
                            </option>
                            untuk melakukan pengecekan seperti if apakah id blk yang ada di paket program sama dengan id blk yang ada di foreach ?
                            @endforeach
                        </select>
                    </div>
            </div> --}}

            <div class="form-group">
                <label for="nama" class="col-md-12 col-form-label">{{ __('Nama Mata Pelajaran') }}</label>
                <input type="text" class="col-md-12 col-form-label" name="nama" required>
            </div>
            <div class="form-group">
                <label for="fotoMataPelajaran" class="col-md-12 col-form-label">{{ __('Foto Mata Pelajaran') }}</label>
                <input type="file" name='fotoMataPelajaran' class="defaults" accept="image/png, image/gif, image/jpeg" required>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>
</div>




{{-- MODAL DELETE MATA PELAJARAN // SOFT DELETE --}}


@endsection