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

<div class="col-sm-6">
    <h1 class="m-0 text-dark">BURSA KERJA</h1><br>
    <h5>Bursa kerja untuk para pencari kerja</h5>
</div>
<div class="container-xl">
    <div class="row">
        <div class="col mx-auto">
            <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="0">
                <!-- Wrapper for carousel items -->
                <div class="carousel-inner">
                    @php
                    $itemke = 0;
                    @endphp
                    @for ($i = 0; $i < 2; $i++) <div class="carousel-item {{ $i == 0 ? 'active' : '' }}">
                        <div class="row">
                            @php
                            $count = 1;
                            @endphp

                            @while ($itemke < count($data)) <div
                                class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                                <div class="card bg-light">
                                    <div class="card-header border-bottom-0 text-primary">
                                        {{$data[$itemke]->nama}}
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="row">
                                            <div class="col-7">
                                                <h1 class="lead"><b>{{ $data[$itemke]->perusahaan->nama }}</b></h1>
                                                {{-- <p class="text-muted text-sm"><b>About: </b> Web Designer / UX / Graphic
                                                    Artist
                                                    /
                                                    Coffee Lover </p> --}}
                                                <ul class="ml-4 mb-0 fa-ul text-muted">
                                                    <li class="small"><span class="fa-li"><i
                                                                class="fas fa-lg fa-building"></i></span> Alamat:
                                                        {{ $data[$itemke]->perusahaan->alamat }}</li>
                                                </ul>
                                            </div>
                                            <div class="col-5 text-center">
                                                <img src="{{ asset('storage/'.$data[$itemke]->perusahaan->logo) }} "
                                                    alt="" class="img-circle img-fluid">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="text-right">
                                            <a href="{{ route('lowongan.show',$data[$itemke]->id) }}"
                                                class="btn btn-sm btn-primary">
                                                Apply
                                            </a>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        @php
                        $itemke +=1;
                        $count+=1;
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

@endsection
