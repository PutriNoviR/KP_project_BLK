@extends('layouts.adminlte')

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
                            {{-- @dd($lamaran) --}}
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
                            @endif
                        </div>
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
@endsection
