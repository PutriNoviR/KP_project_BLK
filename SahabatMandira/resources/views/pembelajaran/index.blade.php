@extends('layouts.adminlte')
@section('title')
MATA PELAJARAN
@endsection


@section('javascript')
<script>
    $(document).ready(function() {
        $("#myTable").DataTable({
            "responsive": true,
            "autoWidth": false,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'print',
                {
                    extend: 'pdfHtml5',
                    customize: function(doc) {
                        doc.content.splice(1, 0);
                        var logo = 'data:image/png;base64,' + '<?= base64_encode(file_get_contents('https://seeklogo.com/images/J/jawa-timur-logo-24818906D1-seeklogo.com.png')) ?>'
                        doc.pageMargins = [20, 100, 20, 30];
                        doc['header'] = (function() {
                            return {
                                columns: [{
                                        image: logo,
                                        width: 45
                                    },
                                    {
                                        alignment: 'center',
                                        text: '',
                                        fontSize: 18,
                                        margin: [10, 0]
                                    },
                                ],
                                margin: 20
                            }
                        });

                    },
                    exportOptions: {
                        columns: [0, 1, 2, 3]
                    }
                },
                'colvis'
            ]
        });
    });

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

<div class="container">

    <div class="col-sm-6">
        <h4 class="m-0 text-dark">DAFTAR MATA PELAJARAN</h4><br>
        <!-- <h6>Berikut adalah overview dari mata pelajaran yang akan di pelajari</h6> -->
    </div>
    {{-- PESERTA PELATIHAN DAN INSTRUKTUR --}}
    @if((Auth::user()->role->nama_role == 'verifikator') || (Auth::user()->role->nama_role == 'peserta'))
    <div class="row ">
        @foreach($mataPelajaranPersesi as $data)
        <div class="col-sm-3 " style="display: flex;">
            <div class="card card-primary ">

                <div class="card-header" style="height: 20%;">
                    <h3 class="card-title">{{$data->mataPelajaran}}</h3>
                </div>
                <div class="card-body" style="height:80% ;">
                    <img src="{{ asset('storage/'.$data->gambar.'') }}" style='width:100%; height:100%; padding: 10px'>
                </div>

                <div class="card-footer">
                    <a href="{{ route('tugasPeserta.index', ['sesi'=> $id_sesi,'mapel'=>$data->id, 'emailMentor'=>$data->email]) }}" class="button btn btn-primary">{{ __('DETAIL') }}</a>
                </div>
            </div>

        </div>
        @endforeach
    </div>

</div>
</div>

{{--UNTUK ADMIN BLK SETELAH MENAMBAHKAN INSTRUKTUR DAN MATA PELAJARAN --}}
@else

{{-- ADMIN BLK --}}
<a data-toggle="modal" data-target="#modalTambahMataPelajaranPersesi" class="button btn btn-outline-primary float-right">
    {{ __('+MATA PELAJARAN PERSESI') }}
</a>
<br><br>
<table class="table table-striped table-bordered table-hover dataTable no-footer" id="myTable" role="grid" aria-describedby="sample_1_info">
    <thead>
        <tr role="row">
            <th>No</th>
            <th>Instruktur</th>
            <th>Mata Pelajaran</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            @foreach($mataPelajaranPersesi as $data)
            <td>{{ $loop->iteration }}</td>
            <td>{{$data->nama_depan}}{{$data->nama_belakang}}</td>
            <td>{{$data->mataPelajaran}}</td>
            <td>
                {{-- masuk ke halaman detail bersamaan dengan mengirimkan paramter id, mapel dan instruktur --}}
                <a href="{{ route('tugasPeserta.index', ['sesi'=> $id_sesi,'emailMentor'=>$data->email]) }}" class="button btn btn-primary">
                    Detail</i>
                </a>
                <a class='btn btn-primary text-white' data-toggle="modal" data-target="#modalEditMataPelajaranPersesi{{$id_sesi}}" class='btn btn-primary text-white'>
                    &nbsp; EDIT
                </a>
                <form method="POST" action="{{ route('pembelajaran.destroy',$id_sesi) }}" onsubmit="return submitFormDelete(this);" class="d-inline">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger" data-toggle="modal" href="" data-toggle="modal"><i class="fas fa-trash"></i>
                    </button>
                    {{-- ambil email dan id matapelajaran --}}
                    <input type="hidden" value="{{$data->email}}" name="email">
                    <input type="hidden" value="{{$data->id}}" name="id">
                </form>

            </td>

        </tr>


        {{-- MODAL EDIT PELAJARAN DAN INSTRUKTUR PELATIHAN --}}

        <div class="modal fade" id="modalEditMataPelajaranPersesi{{$id_sesi}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Mata Pelajaran dan Instruktur</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{-- Untuk mengirim route beserta sesi pelatihannya --}}
                        <form method="POST" action="{{route('pembelajaran.update',['pembelajaran'=> $id_sesi])}}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="nama" class="col-md-12 col-form-label">{{ __('Nama Instruktur') }}</label>
                                <div class="col-md-12">
                                    <select class="blk-select2 form-control" aria-label="Default select example" name="namaInstruktur">
                                        @foreach($instruktur as $i =>$d)

                                        {{-- cek yang di select, d pertama untuk cek cek instruktur $data dari mata pelajaran persesi --}}
                                        <option value="{{$d->email}}" {{($d->email == $data->email  )? 'selected':''}}>{{$d->nama_depan}} {{$d->nama_belakang}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="nama" class="col-md-12 col-form-label">{{ __('Nama Mata Pelajaran') }}</label>
                                <div class="col-md-12">
                                    <select class="blk-select2 form-control" aria-label="Default select example" name="nama">
                                        @foreach($mataPelajaran as $i =>$d)
                                        <option value="{{$d->id}}" {{($d->id == $data->id )? 'selected':''}}>{{$d->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <input type="hidden" name="old_sesi" value="{{$id_sesi}}">
                            <input type="hidden" name="old_mapel" value="{{$data->id}}">
                            <input type="hidden" name="old_mentor" value="{{$data->email}}">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </tbody>
</table>

{{-- PESERTA PELATIHAN DAN INSTRUKTUR  --}}

<div class="modal fade" id="modalTambahMataPelajaranPersesi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Mata Pelajaran dan Instruktur</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form method="POST" action="{{route('pembelajaran.store')}}">
                    @csrf
                    <div class="form-group">
                        <label for="nama" class="col-md-12 col-form-label">{{ __('Nama Instruktur') }}</label>
                        <div class="col-md-12">
                            <select class="blk-select2 form-control" aria-label="Default select example" name="namaInstruktur">
                                @foreach($instruktur as $i =>$d)
                                <option value="{{$d->email}}" {{($i == 0 )? 'selected':''}}>{{$d->nama_depan}} {{$d->nama_belakang}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nama" class="col-md-12 col-form-label">{{ __('Nama Mata Pelajaran') }}</label>
                        <div class="col-md-12">
                            <select class="blk-select2 form-control" aria-label="Default select example" name="nama">
                                @foreach($mataPelajaran as $i =>$d)
                                <option value="{{$d->id}}" {{($i == 0 )? 'selected':''}}>{{$d->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <input type="hidden" name="sesi" value="{{$id_sesi}}">

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endif
@endsection