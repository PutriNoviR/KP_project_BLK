@extends('layouts.adminlte')

@section('javascript')
<script>
    @if(count($errors) > 0)
    $('#daftarLowonganModal').modal('show');
    @endif
    @foreach($dokumenLowongan as $dokumen)
    $('#{{ $dokumen->nama }}').on('change', function () {
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
                            {{-- @if ($lamaran != null && $lamaran->users_email == Auth::user()->email &&
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

                        <form method="POST" action="{{ route('lamaran.store') }}">
                            @csrf
                            <input type="hidden" value="{{ $lowongan->id }}" name="id_lowongan">
                            <button type="submit" class="btn btn-primary btn-lg px-5 ">Daftar</button>
                        </form>
                        @endif --}}
                        <div>
                            <button type="button" class="btn btn-primary px-5 " data-toggle="modal"
                                data-target="#daftarLowonganModal">Daftar</button>
                        </div>
                    </div>
                </div>
                <div class="post clearfix">
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
                </div>
                <div class="post clearfix">
                    <div class="user-block">
                        <b>Deskripsi Pekerjaan</b>
                    </div>
                    <p>
                        {{$lowongan->deskripsi_kerja}}
                    </p>
                </div>
                <div class="post clearfix">
                    <div class="user-block">
                        <b>Tentang Perusahaan</b>
                    </div>
                    <p>
                        {{$lowongan->perusahaan->tentang_perusahaan}}
                    </p>
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
                <h3 class="text-primary"><i class="fas fa-paint-brush"></i> {{ $lowongan->perusahaan->nama }}</h3>
                <p class="text-muted">{{ $lowongan->perusahaan->tentang_perusahaan }}</p>
                <br>
                <div class="text-muted">
                    <p class="text-sm">Client Company
                        <b class="d-block">Deveint Inc</b>
                    </p>
                    <p class="text-sm">Project Leader
                        <b class="d-block">Tony Chicken</b>
                    </p>
                </div>

                <h5 class="mt-5 text-muted">{{ $lowongan->nama }}</h5>
                <ul class="list-unstyled">
                    <li>
                        <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-file-word"></i>
                            Functional-requirements.docx</a>
                    </li>
                    <li>
                        <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-file-pdf"></i> UAT.pdf</a>
                    </li>
                    <li>
                        <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-envelope"></i>
                            Email-from-flatbal.mln</a>
                    </li>
                    <li>
                        <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-image "></i> Logo.png</a>
                    </li>
                    <li>
                        <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-file-word"></i>
                            Contract-10_12_2014.docx</a>
                    </li>
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
                            <input type="file" name="{{ $dokumen->nama }}" class="custom-file-input"
                                id="{{ $dokumen->nama }}">
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
