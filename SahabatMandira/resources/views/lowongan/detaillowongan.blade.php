@extends('layouts.adminlte')

@section('javascript')
<script>
    @if(count($errors) > 0)
    $('#daftarLowonganModal').modal('show');
    @endif
    @foreach($dokumenLowongan as $dokumen)
    $('#{{str_replace(" ", "_", $dokumen->nama)}}').on('change', function () {
        //get the file name
        var fileName = $(this).val().replace('C:\\fakepath\\', " ");
        //replace the "Choose a file" label
        $(this).next('.custom-file-label').html(fileName);
    });
    @endforeach

</script>
@endsection

@section('contents')
<section class="content">

    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $lowongan->nama }}</h3>
        </div>
        <div class="card-body">
            @if (\Session::has('success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                {!! \Session::get('success') !!}
            </div>
            @endif
            <div class="row">
                <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                    <div class="d-flex ">
                        <img src="{{ asset('storage/'.$lowongan->perusahaan->logo) }}" class="img-thumbnail" alt="...">
                        <div class="mx-auto d-flex flex-column justify-content-between py-4">
                            <div>
                                <h1>{{ $lowongan->nama }}</h1>
                                <p class="FontComic display-5 text-primary">{{ $lowongan->perusahaan->nama }}</p>
                                <p class="display-5">{{ $lowongan->perusahaan->alamat }}</p>
                            </div>
                            @if ($lamaran != null && $lamaran->users_email == Auth::user()->email &&
                            $lamaran->lowongans_id ==
                            $lowongan->id)
                            <div>
                                @if ($lamaran->status == 'Terdaftar')
                                <button type="button"
                                    class="btn btn-outline-success btn-lg disabled">{{ $lamaran->status }}</button>
                                @elseif ($lamaran->status == 'Tahap Seleksi')
                                <button type="button"
                                    class="btn btn-outline-warning btn-lg disabled">{{ $lamaran->status }}</button>
                                @elseif ($lamaran->status == 'Diterima')
                                <button type="button"
                                    class="btn btn-outline-success btn-lg disabled">{{ $lamaran->status }}</button>
                                @else
                                <button type="button"
                                    class="btn btn-outline-danger btn-lg disabled">{{ $lamaran->status }}</button>
                                @endif
                            </div>
                            @else

                            <div>
                                <button type="button" class="btn btn-primary px-5 " data-toggle="modal"
                                    data-target="#daftarLowonganModal">Daftar</button>
                            </div>
                            @endif

                        </div>
                    </div>
                    {{-- <div class="post clearfix">
                        <div class="user-block">
                            <b>Gaji</b>
                            <p>{{$lowongan->gaji}}</p>
                </div>
                <div class="user-block">
                    <b>Lokasi Kerja</b>
                    <p>{{$lowongan->lokasi_kerja}}</p>
                </div>
                <div class="user-block">
                    <b>Pengalaman Kerja</b>
                    <p>{{$lowongan->pengalaman_kerja}} Tahun</p>
                </div>
                <div class="user-block">
                    <b>Kualifikasi pendidikan</b>
                    <p>{{$lowongan->pendidikan_terakhir}}</p>
                </div>
            </div> --}}
            <div class="post clearfix"></div>
            <div class="post clearfix">
                <div class="user-block">
                    <b>Deskripsi Pekerjaan</b>
                </div>
                <p>
                    {!!$lowongan->deskripsi_kerja!!}
                </p>
            </div>
            <div class="post clearfix">
                <div class="user-block">
                    <b>Kualifikasi Minimal</b>
                </div>
                <p>
                    {!! $lowongan->kualifikasi_minimal !!}
                </p>
            </div>
            <div class="post clearfix">
                <div class="user-block">
                    <b>Tentang Perusahaan</b>
                </div>
                <p>
                    {!! $lowongan->perusahaan->tentang_perusahaan !!}
                </p>
            </div>
        </div>
        <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
            <h3 class="text-primary"><i class="fas fa-paint-brush"></i> {{ $lowongan->perusahaan->nama }}</h3>
            <p class="text-muted">{!! $lowongan->perusahaan->tentang_perusahaan !!}</p>
            <h5 class="mt-5 ">Dokumen Persyaratan</h5>
            <ul class="list-unstyled">
                @foreach ($dokumenLowongan as $dl)
                <li>
                    <span href="" class="btn-link text-secondary"><i class="far fa-fw fa-file-word"></i>
                        {{ $dl->nama }}</span>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    </div>
    <!-- /.card-body -->
    </div>
    <!-- /.card -->

</section>

<!-- Modal -->
<div class="modal fade" id="daftarLowonganModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Dokumen Persyaratan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if(count($errors) > 0)
                @foreach($errors->all() as $error)
                <div class="alert alert-danger">
                    <li>{{$error}}</li>
                </div>
                @endforeach
                @endif
                <form method="POST" action="{{ route('lamaran.store') }}" enctype="multipart/form-data">
                    @foreach ($dokumenLowongan as $dokumen)
                    @csrf
                    <input type="hidden" value="{{ $lowongan->id }}" name="id_lowongan">
                    <div class="form-group">
                        <label for="" class="form-label">{{ $dokumen->nama }}</label>
                        <div class="custom-file">
                            <input type="file" name="{{str_replace(" ", "_", $dokumen->nama)}}"
                                class="custom-file-input" id="{{str_replace(" ", "_", $dokumen->nama)}}">
                            <label class="custom-file-label" for="inputGroupFile02"
                                aria-describedby="inputGroupFileAddon02">Choose file</label>
                        </div>
                        <p class="text-muted text-sm">Jenis dokumen yang mendukung : pdf,png,jpg</p>
                    </div>
                    @endforeach
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Daftar</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection
