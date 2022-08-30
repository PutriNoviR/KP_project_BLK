@extends('layouts.adminlte')

@section('title')
Bursa Kerja
@endsection

@section('style')
<style>
    .carousel {
        margin: 30px auto 60px !important;
        padding: 0 80px !important;
    }

    .carousel .carousel-item {
        text-align: center !important;
        overflow: hidden !important;
    }

    .carousel .carousel-item h4 {
        font-family: 'Varela Round', sans-serif !important;
    }

    .carousel .carousel-item img {
        max-width: 100% !important;
        display: inline-block !important;
    }

    .carousel .carousel-item .btn {
        border-radius: 0 !important;
        font-size: 12px !important;
        text-transform: uppercase !important;
        font-weight: bold !important;
        border: none !important;
        padding: 6px 15px !important;
        margin-top: 5px !important;
    }

    .carousel .carousel-item .btn:hover {
        /* background: #8c5bff !important; */
    }

    .carousel .carousel-item .btn i {
        font-size: 14px !important;
        font-weight: bold !important;
        margin-left: 5px !important;
    }

    .carousel .thumb-wrapper {
        margin: 5px !important;
        text-align: left !important;
        background: #fff !important;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1) !important;
    }

    .carousel .thumb-content {
        padding: 15px !important;
        font-size: 13px !important;
    }

    .carousel-control-prev,
    .carousel-control-next {
        height: 44px !important;
        width: 44px !important;
        background: none !important;
        margin: auto 0 !important;
        border-radius: 50% !important;
        border: 3px solid rgba(0, 0, 0, 0.8) !important;
    }

    .carousel-control-prev i,
    .carousel-control-next i {
        font-size: 36px !important;
        position: absolute !important;
        top: 50% !important;
        display: inline-block !important;
        margin: -19px 0 0 0 !important;
        z-index: 5 !important;
        left: 0 !important;
        right: 0 !important;
        color: rgba(0, 0, 0, 0.8) !important;
        text-shadow: none !important;
        font-weight: bold !important;
    }

    .carousel-control-prev i {
        margin-left: -3px !important;
    }

    .carousel-control-next i {
        margin-right: -3px !important;
    }

    .carousel-indicators {
        bottom: -50px !important;
    }

    .carousel-indicators li,
    .carousel-indicators li.active {
        width: 10px !important;
        height: 10px !important;
        border-radius: 50% !important;
        margin: 4px !important;
        border: none !important;
    }

    .carousel-indicators li {
        background: #ababab !important;
    }

    .carousel-indicators li.active {
        background: #555 !important;
    }

</style>
@endsection

@section('javascript')
@endsection

@section('contents')

<div class="modal fade" id="modalDetailKerja" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" id="modalContent">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Kerja</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="form-group">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Daftar</button>
                </div>
            </div>
        </div>
    </div>
</div>

@if(Auth::user()->role->nama_role == 'peserta')
<div class="col-sm-6">
    <h1 class="m-0 text-dark">BURSA KERJA</h1><br>
    <h5>Bursa kerja untuk para pencari kerja</h5>
</div>
<div class="container-xl">
    <div class="row">
        <div class="col mx-auto">
            <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="0">
                <!-- Wrapper for carousel items -->
                @php
                $itemku = 0;
                @endphp
                <div class="carousel-inner">
                    @for ($i = 0; $i < 2; $i++) <div class="carousel-item {{ $i == 0 ? 'active' : '' }}">
                        <div class="row">
                            @php
                            $count = 1;
                            @endphp
                            @while ($itemku < count($data)) <div
                                class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                                <div class="card bg-light">
                                    <div class="card-header text-muted border-bottom-0">
                                        {{ $data[$itemku]->perusahaan->nama }}
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="row">
                                            <div class="col-7">
                                                <h2 class="lead"><b>{{ $data[$itemku]->posisi }}</b></h2>
                                                <p class="text-muted text-sm"><b>About: </b> {{ $data[$itemku]->nama }}
                                                </p>
                                                <ul class="ml-4 mb-0 fa-ul text-muted">
                                                    <li class="small"><span class="fa-li"><i
                                                                class="fas fa-lg fa-building"></i></span> Address:
                                                        {{ $data[$itemku]->perusahaan->alamat }}</li>
                                                    <li class="small"><span class="fa-li"><i
                                                                class="fas fa-lg fa-phone"></i></span> Phone #:
                                                        {{ $data[$itemku]->perusahaan->no_telp }}</li>
                                                </ul>
                                            </div>
                                            <div class="col-5 text-center">
                                                <img src="{{ asset('storage/'.$data[$itemku]->perusahaan->logo) }}"
                                                    alt="" class="img-circle img-fluid">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="text-right">
                                            <a href="#" class="btn btn-sm bg-teal">
                                                <i class="fas fa-comments"></i>
                                            </a>
                                            <a href="#" class="btn btn-sm btn-primary">
                                                <i class="fas fa-user"></i> View Profile
                                            </a>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        @php
                        $count += 1;
                        $itemku += 1;
                        @endphp
                        @if ($count == 4)
                        @break
                        @endif
                        @endwhile
                </div>
            </div>
            @endfor
        </div>
        <!-- Carousel controls -->
        <a class="carousel-control-prev" href="#myCarousel" data-slide="prev">
            <i class="fa fa-angle-left"></i>
        </a>
        <a class="carousel-control-next" href="#myCarousel" data-slide="next">
            <i class="fa fa-angle-right"></i>
        </a>
    </div>
</div>
</div>
</div>
{{-- @foreach ($data as $d)
<div class="col-sm-3 float-left">
    <div class="card card-primary ">
        <div class="card-header">
            <h3 class="card-title">{{ $d->nama}}</h3>
</div>
<div class="card-body">
    <h1><img src="{{ asset('$d->logo') }}" alt=""></h1>
</div>
<div class="card-body">
    <h5>{{ $d->posisi}}</h5>
</div>
<div class="card-body">
    <small>Tanggal Pemasangan</small>
</div>
<div class="card-footer">
    <a data-toggle="modal" data-target="#modalTambahInstruktur" class='btn btn-primary '>
        Detail
    </a>
</div>
</div>
</div>
@endforeach --}}

@endif
@endsection
