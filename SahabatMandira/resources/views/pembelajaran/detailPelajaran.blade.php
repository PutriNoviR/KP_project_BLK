@extends('layouts.adminlte')
@section('title')
DETAIL PEMBELAJARAN
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
    <div class="d-flex justify-content-between mb-2">
        <h2>DAFTAR TUGAS
        </h2>

        @if((Auth::user()->role->nama_role == 'adminblk' || Auth::user()->role->nama_role == 'verifikator'))
        {{-- UNTUK INSTRUKTUR --}}
        <a data-toggle="modal" data-target="#modalTambahTugas" class="button btn btn-outline-primary float-right ">
            {{ __('Tambah Tugas') }}
        </a>
        @endif
    </div>

</div>

<table class="table table-striped table-bordered table-hover dataTable no-footer" id="myTable" role="grid" aria-describedby="sample_1_info">
    <thead>
        <tr role="row">
            <th>No</th>
            <th>Topik</th>
            <th>Judul</th>
            <th>Detail</th>
            <th>Tanggal Awal Pengumpulan</th>
            <th>Tanggal Akhir Pengumpulan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            @foreach($tugasPermataPelajaran as $d)
            <td>{{$loop->iteration}}</td>
            <td>{{$d['topik']}}</td>
            <td>{{$d['judul']}}</td>
            <td>{{$d['detail']}}</td>
            <td>{{$d['tanggal_buka']}}</td>
            <td>{{$d['tanggal_tutup']}}</td>
            <td>
                {{-- masuk ke halaman detail bersamaan dengan mengirimkan paramter id, mapel dan instruktur --}}
                @if((Auth::user()->role->nama_role == 'adminblk' || Auth::user()->role->nama_role == 'verifikator'))
                <a href="{{route('jawabanTugasPeserta.jawabanPeserta',['id'=>$d['id']])}}" class="button btn btn-primary">
                    Detail</i>
                </a>
                <a class='btn btn-primary text-white' data-toggle="modal" data-target="#modalEditTugas_{{$loop->iteration}}" class='btn btn-primary text-white'>
                    &nbsp; EDIT
                </a>
                <form method="POST" action="{{route('tugasPeserta.destroy',[$d['id']])}}" onsubmit="return submitFormDelete(this);" class="d-inline">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger" data-toggle="modal" href="" data-toggle="modal"><i class="fas fa-trash"></i>
                    </button>
                    {{-- ambil email dan id matapelajaran 
                    <input type="hidden" value="{{$data->email}}" name="email"> --}}
                    <input type="hidden" value="{{$d['id']}}" name="id">
                </form>
                

                {{-- PESERTA PELATIHAN --}}
                @else
                @if(!isset($d['updated_at']))
                <a data-target="#modalKumpulTugas_{{$loop->iteration}}" data-toggle="modal" class="button btn btn-primary text-white" style="width: 100%;">
                    Kumpul Tugas</i>
                </a>
                @else
                <br><br>
                <a class='btn btn-primary text-white' data-toggle="modal" data-target="#modalEditPengumpulanTugas{{$loop->iteration}}" class='btn btn-primary text-white' style="width: 100%;">
                    &nbsp; Edit Tugas
                </a>
                @endif
                @php
                $idJawaban = $d['idJawaban'];
                @endphp
                {{--<form method="POST" action="{{route('jawabanTugasPeserta.destroy',['jawabantugasPesertum'=>$idJawaban])}}" onsubmit="return submitFormDelete(this);" class="d-inline">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger" data-toggle="modal" data-toggle="modal"><i class="fas fa-trash"></i>
                    </button>
                     ambil email dan id matapelajaran
                    <input type="hidden" value="{{$d['idJawaban']}}" name="id">
                </form>--}}
                @endif
            </td>
        </tr>
        {{-- MODAL EDIT TUGAS PESERTA --}}
        <div class="modal fade" id="modalEditTugas_{{$loop->iteration}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Tugas Peserta Pelatihan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{route('tugasPeserta.update',['tugasPesertum'=> $d['id']])}}" enctype="multipart/form-data">
                            @csrf
                            @method("PUT")
                            <div class="form-group">
                                <label for="topik" class="col-md-12 col-form-label">{{ __('Topik Penugasan') }}</label>
                                <input type="text" class="col-md-12 col-form-label" name="topik" value="{{$d['topik']}}">
                            </div>

                            <div class="form-group">
                                <label for="judulTugas" class="col-md-12 col-form-label">{{ __('Judul Tugas') }}</label>
                                <input type="text" class="col-md-12 col-form-label" name="judulTugas" value="{{$d['judul']}}">
                            </div>

                            <div class="form-group">
                                <label for="detailPenugasan" class="col-md-12 col-form-label">{{ __('Detail Penugasan') }}</label>
                                <textarea name="detailPenugasan" class="form-control topik" id="detailPenugasan" cols="40" rows="10">{{$d['detail']}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="tanggalAwalPengumpulan" class="col-md-12 col-form-label">{{ __('Tanggal Awal Pengumpulan') }}</label>
                                <input type="datetime-local" class="col-md-12 col-form-label" name="tanggalAwalPengumpulan" value="{{$d['tanggal_buka']}}">

                                <div class="col-md-12">

                                    @error('tanggalAwalPengumpulan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tanggalAkhirPengumpulan" class="col-md-12 col-form-label">{{ __('Tanggal Akhir Pengumpulan') }}</label>
                                <input type="datetime-local" class="col-md-12 col-form-label" name="tanggalAkhirPengumpulan" value="{{$d['tanggal_tutup']}}">

                                <div class="col-md-12">

                                    @error('tanggalAkhirPengumpulan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            {{--instruktur yang ngajar di mata pelajaran itu aja --}}
                            @if(Auth::user()->role->nama_role == 'adminblk')
                            <div class="form-group">
                                <label for="nama" class="col-md-12 col-form-label">{{ __('Nama Instruktur') }}</label>
                                <div class="col-md-12">
                                    <select class="blk-select2 form-control" aria-label="Default select example" name="namaInstruktur">
                                        @foreach($namaInstrukturPersesi as $i =>$data)
                                        <option value="{{$data->email}}" {{($i == 0 )? 'selected':''}}>{{$data->nama_depan}} {{$data->nama_belakang}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="keterangan" class="col-md-12 col-form-label">{{ __('Keterangan') }}</label>
                                <div class="col-md-12">
                                    <input id="keterangan" type="text" class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" value="{{$d['keterangan']}}" required autocomplete="keterangan">

                                    @error('keterangan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="buktiKonfirmasi" class="col-md-12 col-form-label">{{ __('Bukti Konfirmasi') }}</label>

                                <input type="file" name='bukti' class="defaults" value="">
                            </div>
                            @endif
                            @php
                            $sesiPelatihan = $_GET['sesi'];
                            @endphp
                            <input type="hidden" name="sesi_pelatihan" value="{{$sesiPelatihan}}">
                            <input type="hidden" name="id" value="{{$d['id']}}">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">BATAL</button>
                                <button type="submit" class="btn btn-primary">SIMPAN</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        

        {{-- MODAL KUMPUL TUGAS PESERTA --}}
        <div class="modal fade" id="modalKumpulTugas_{{$loop->iteration}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Kumpul Tugas</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{route('jawabanTugasPeserta.store')}}" enctype="multipart/form-data">
                            @csrf
                            <div>
                                <label for="fileTugas" class="col-md-12 col-form-label">{{ __('File Tugas') }}</label>
                                <input type="file" name="fileTugas" id="upload" />
                            </div>

                            <div class="form-group">
                                <label for="jawabanTertulis" class="col-md-12 col-form-label">{{ __('Jawaban Tertulis') }}</label>
                                <textarea name="jawabanTertulis" class="form-control topik" id="jawabanTertulis" cols="40" rows="20"></textarea>
                            </div>
                            <input type="hidden" value="{{$d['id']}}" name="id">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">BATAL</button>
                                <button type="submit" class="btn btn-primary">SIMPAN</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        {{-- MODAL EDIT PENGUMPULAN TUGAS PESERTA --}}
        <div class="modal fade" id="modalEditPengumpulanTugas{{$loop->iteration}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Pengumpulan Tugas</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{url('jawabanTugasPeserta/'.$d['id'])}}" enctype="multipart/form-data">
                            @csrf
                            @method("PUT")
                            <div>
                                <label for="fileTugas" class="col-md-12 col-form-label">{{ __('File Tugas') }}</label>
                                <input type="file" name="fileTugas" id="upload" value="{{!isset($d['fileJawaban']) ? '':(asset('storage/app/public/jawabanTugasPeserta'.$d['fileJawaban']))}}" />
                            </div>

                            <div class="form-group">
                                <label for="jawabanTertulis" class="col-md-12 col-form-label">{{ __('Jawaban Tertulis') }}</label>
                                <textarea name="jawabanTertulis" class="form-control topik" id="jawabanTertulis" cols="40" rows="20">{{!isset($d['jawabanTertulis'])? '':$d['jawabanTertulis']}}</textarea>
                            </div>
                            <input type="hidden" value="{{!isset($d['idJawaban']) ? '' : $d['idJawaban']}}" name="id">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">BATAL</button>
                                <button type="submit" class="btn btn-primary">SIMPAN</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </tbody>
</table>

{{-- MODAL UNTUK TAMBAH TUGAS--}}
<div class="modal fade" id="modalTambahTugas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Tugas Peserta Pelatihan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{route('tugasPeserta.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="topik" class="col-md-12 col-form-label">{{ __('Topik Penugasan') }}</label>
                        <input type="text" class="col-md-12 col-form-label" name="topik">
                    </div>

                    <div class="form-group">
                        <label for="judulTugas" class="col-md-12 col-form-label">{{ __('Judul Tugas') }}</label>
                        <input type="text" class="col-md-12 col-form-label" name="judulTugas">
                    </div>

                    <div class="form-group">
                        <label for="detailPenugasan" class="col-md-12 col-form-label">{{ __('Detail Penugasan') }}</label>
                        <textarea name="detailPenugasan" class="form-control topik" id="detailPenugasan" cols="40" rows="10"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="tanggalAwalPengumpulan" class="col-md-12 col-form-label">{{ __('Tanggal Awal Pengumpulan') }}</label>
                        <input type="datetime-local" class="col-md-12 col-form-label" name="tanggalAwalPengumpulan">

                        <div class="col-md-12">

                            @error('tanggalAwalPengumpulan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tanggalAkhirPengumpulan" class="col-md-12 col-form-label">{{ __('Tanggal Akhir Pengumpulan') }}</label>
                        <input type="datetime-local" class="col-md-12 col-form-label" name="tanggalAkhirPengumpulan">

                        <div class="col-md-12">

                            @error('tanggalAkhirPengumpulan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    {{--instruktur yang ngajar di mata pelajaran itu aja --}}
                    @if(Auth::user()->role->nama_role == 'adminblk')
                    <div class="form-group">
                        <label for="nama" class="col-md-12 col-form-label">{{ __('Nama Instruktur') }}</label>
                        <div class="col-md-12">
                            <select class="blk-select2 form-control" aria-label="Default select example" name="namaInstruktur">
                                @foreach($namaInstrukturPersesi as $i =>$d)
                                <option value="{{$d->email}}" {{($i == 0 )? 'selected':''}}>{{$d->nama_depan}} {{$d->nama_belakang}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="keterangan" class="col-md-12 col-form-label">{{ __('Keterangan') }}</label>
                        <div class="col-md-12">
                            <input id="keterangan" type="text" class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" required autocomplete="keterangan" autofocus>

                            @error('keterangan')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="buktiKonfirmasi" class="col-md-12 col-form-label">{{ __('Bukti Konfirmasi') }}</label>

                        <input type="file" name='bukti' class="defaults" value="" required>
                    </div>
                    @endif
                    @php
                    $sesiPelatihan = $_GET['sesi'];
                    @endphp
                    <input type="hidden" name="sesi_pelatihan" value="{{$sesiPelatihan}}">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">BATAL</button>
                        <button type="submit" class="btn btn-primary">SIMPAN</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection