@extends('layouts.adminlte')

@section('title')
DAFTAR PAKET PROGRAM
@endsection

@section('page-bar')
<ul class="page-breadcrumb">
    <li>
        <i class="fa fa-home"></i>
        <a href="http://127.0.0.1:8000/">Dashboard</a>
        <i class="fa fa-angle-right"></i>
    </li>

    <li>
        <a href="http://127.0.0.1:8000/menu/kejuruan">SESI PELATIHAN</a>
        <i class="fa fa-angle-right"></i>
    </li>
</ul>
@endsection

@section('contents')
<div class="container">
    <div class="d-flex justify-content-between mb-2">
        <h2>Daftar Sesi Pelatihan</h2>
    </div>
    @if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
    @endif
    <table class="table table-striped table-bordered table-hover dataTable no-footer" id="myTable" role="grid" aria-describedby="sample_1_info">
        <thead>
            <tr role="row">
                <th>No</th>
                <th>Nama Balai Latihan Kerja</th>
                <th>Kejuruan</th>
                <th>Tanggal Buka Pendaftaran</th>
                <th>Tanggal Tutup Pendaftaran</th>
                <th>Lokasi</th>
                <th>Kuota</th>
                <th>Tanggal Seleksi</th>
                <th>Aktivitas</th>

                <th>Aksi</th>
            </tr>
        </thead>
        <tbody id="myTable">
            @foreach($data as $d)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $d->blks->nama }}</td>
                <td>{{ $d->kejuruan->nama }}</td>
                <td>{{ $d->sub_kejuruans->nama }}</td>
                <td>
                    <a data-toggle="modal" data-target="#modalEditBlk" class='btn btn-warning' onclick="modalEdit({{$d->id}})">
                        <i class="fas fa-pen"></i>
                    </a>
                    <form method="POST" action="{{ route('sesiPelatihan.destroy',$d->id) }}" onsubmit="return submitFormDelete(this);" class="d-inline">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger" data-toggle="modal" href="{{route('blk.show',$d->id)}}" data-toggle="modal"><i class="fas fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Edit Sesi Pelatihan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <form method="post" action="{{ route('sesiPelatihan.update',$sesiPelatihan->id) }}">
            @csrf
            @method('PUT')

            <div class="form-group">

                <label for="nama" class="col-md-12 col-form-label">{{ __('Tanggal Buka Pendaftaran') }}</label>
                <div class="col-md-12">
                    <select class="form-control" aria-label="Default select example" name="tanggalBukaPendaftaran">
                        @foreach($tanggalBukaPendaftaran as $d)
                        <option value="{{$d->id}}" {{$d->id==$sesiPelatihan->tanggal_pendaftaran ? 'selected':''}}>{{$d->nama}}</option> {{-- untuk melakukan pengecekan seperti if apakah id blk yang ada di paket program sama dengan id blk yang ada di foreach ?--}}
                        @endforeach
                    </select>

                    @error('website')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="kejuruan" class="col-md-12 col-form-label">{{ __('Tanggal Tutup Pendaftaran') }}</label>

                <div class="col-md-12">
                    <select class="form-control" aria-label="Default select example" name="tanggalTutupPendaftaran">
                        @foreach($kejuruan as $d)
                        <option value="{{$d->id}}" {{$d->id==$$sesiPelatihan->tanggal_tutup ? 'selected':''}}>{{$d->nama}}</option> {{-- untuk melakukan pengecekan seperti if apakah id blk yang ada di paket program sama dengan id kejuruan yang ada di foreach ?--}}
                        @endforeach
                    </select>

                    @error('website')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="subKejuruan" class="col-md-12 col-form-label">{{ __('Lokasi') }}</label>

                <div class="col-md-12">

                    <select class="form-control" aria-label="Default select example" name="lokasi">
                        @foreach($subKejuruan as $d)
                        <option value="{{$d->id}}" {{$d->id==$sesiPelatihan->lokasi ? 'selected':''}}>{{$d->nama}}</option> {{-- untuk melakukan pengecekan seperti if apakah id blk yang ada di paket program sama dengan id kejuruan yang ada di foreach ?--}}
                        @endforeach
                    </select>

                    @error('website')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="subKejuruan" class="col-md-12 col-form-label">{{ __('Tanggal Mulai Pelatihan') }}</label>

                <div class="col-md-12">

                    <select class="form-control" aria-label="Default select example" name="tanggalMulaiPelatihan">
                        @foreach($subKejuruan as $d)
                        <option value="{{$d->id}}" {{$d->id==$sesiPelatihan->tanggal_mulai_pelatihan ? 'selected':''}}>{{$d->nama}}</option> {{-- untuk melakukan pengecekan seperti if apakah id blk yang ada di paket program sama dengan id kejuruan yang ada di foreach ?--}}
                        @endforeach
                    </select>

                    @error('website')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="subKejuruan" class="col-md-12 col-form-label">{{ __('Tanggal Selesai Pelatihan') }}</label>

                <div class="col-md-12">

                    <select class="form-control" aria-label="Default select example" name="tanggalSelesaiPelatihan">
                        @foreach($subKejuruan as $d)
                        <option value="{{$d->id}}" {{$d->id==$sesiPelatihan->tanggal_selesai_pelatihan ? 'selected':''}}>{{$d->nama}}</option> {{-- untuk melakukan pengecekan seperti if apakah id blk yang ada di paket program sama dengan id kejuruan yang ada di foreach ?--}}
                        @endforeach
                    </select>

                    @error('website')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="subKejuruan" class="col-md-12 col-form-label">{{ __('Harga') }}</label>

                <div class="col-md-12">

                    <select class="form-control" aria-label="Default select example" name="harga">
                        @foreach($subKejuruan as $d)
                        <option value="{{$d->id}}" {{$d->id==$sesiPelatihan->harga ? 'selected':''}}>{{$d->nama}}</option> {{-- untuk melakukan pengecekan seperti if apakah id blk yang ada di paket program sama dengan id kejuruan yang ada di foreach ?--}}
                        @endforeach
                    </select>

                    @error('website')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="subKejuruan" class="col-md-12 col-form-label">{{ __('Kuota') }}</label>

                <div class="col-md-12">

                    <select class="form-control" aria-label="Default select example" name="kuota">
                        @foreach($subKejuruan as $d)
                        <option value="{{$d->id}}" {{$d->id==$sesiPelatihan->kuota ? 'selected':''}}>{{$d->nama}}</option> {{-- untuk melakukan pengecekan seperti if apakah id blk yang ada di paket program sama dengan id kejuruan yang ada di foreach ?--}}
                        @endforeach
                    </select>

                    @error('website')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="subKejuruan" class="col-md-12 col-form-label">{{ __('Tanggal Seleksi') }}</label>

                <div class="col-md-12">

                    <select class="form-control" aria-label="Default select example" name="tanggalSeleksi">
                        @foreach($subKejuruan as $d)
                        <option value="{{$d->id}}" {{$d->id==$sesiPelatihan->tanggal_seleksi ? 'selected':''}}>{{$d->nama}}</option> {{-- untuk melakukan pengecekan seperti if apakah id blk yang ada di paket program sama dengan id kejuruan yang ada di foreach ?--}}
                        @endforeach
                    </select>

                    @error('website')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="subKejuruan" class="col-md-12 col-form-label">{{ __('Aktivitas') }}</label>

                <div class="col-md-12">

                    <select class="form-control" aria-label="Default select example" name="aktivitas">
                        @foreach($subKejuruan as $d)
                        <option value="{{$d->id}}" {{$d->id==$sesiPelatihan->aktivitas ? 'selected':''}}>{{$d->nama}}</option> {{-- untuk melakukan pengecekan seperti if apakah id blk yang ada di paket program sama dengan id kejuruan yang ada di foreach ?--}}
                        @endforeach
                    </select>

                    @error('website')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>