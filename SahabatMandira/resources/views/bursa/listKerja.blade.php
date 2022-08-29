@extends('layouts.adminlte')

@section('title')
Bursa Kerja
@endsection

@section('style')
<style>
    @media (min-width: 768px) and (max-width: 991px) {

        /* Show 4th slide on md if col-md-4*/
        .carousel-inner .active.col-md-4.carousel-item+.carousel-item+.carousel-item+.carousel-item {
            position: absolute;
            top: 0;
            right: -33.3333%;
            /*change this with javascript in the future*/
            z-index: -1;
            display: block;
            visibility: visible;
        }
    }

    @media (min-width: 576px) and (max-width: 768px) {

        /* Show 3rd slide on sm if col-sm-6*/
        .carousel-inner .active.col-sm-6.carousel-item+.carousel-item+.carousel-item {
            position: absolute;
            top: 0;
            right: -50%;
            /*change this with javascript in the future*/
            z-index: -1;
            display: block;
            visibility: visible;
        }
    }

    @media (min-width: 576px) {
        .carousel-item {
            margin-right: 0;
        }

        /* show 2 items */
        .carousel-inner .active+.carousel-item {
            display: block;
        }

        .carousel-inner .carousel-item.active:not(.carousel-item-right):not(.carousel-item-left),
        .carousel-inner .carousel-item.active:not(.carousel-item-right):not(.carousel-item-left)+.carousel-item {
            transition: none;
        }

        .carousel-inner .carousel-item-next {
            position: relative;
            transform: translate3d(0, 0, 0);
        }

        /* left or forward direction */
        .active.carousel-item-left+.carousel-item-next.carousel-item-left,
        .carousel-item-next.carousel-item-left+.carousel-item,
        .carousel-item-next.carousel-item-left+.carousel-item+.carousel-item {
            position: relative;
            transform: translate3d(-100%, 0, 0);
            visibility: visible;
        }

        /* farthest right hidden item must be also positioned for animations */
        .carousel-inner .carousel-item-prev.carousel-item-right {
            position: absolute;
            top: 0;
            left: 0;
            z-index: -1;
            display: block;
            visibility: visible;
        }

        /* right or prev direction */
        .active.carousel-item-right+.carousel-item-prev.carousel-item-right,
        .carousel-item-prev.carousel-item-right+.carousel-item,
        .carousel-item-prev.carousel-item-right+.carousel-item+.carousel-item {
            position: relative;
            transform: translate3d(100%, 0, 0);
            visibility: visible;
            display: block;
            visibility: visible;
        }
    }

    /* MD */
    @media (min-width: 768px) {

        /* show 3rd of 3 item slide */
        .carousel-inner .active+.carousel-item+.carousel-item {
            display: block;
        }

        .carousel-inner .carousel-item.active:not(.carousel-item-right):not(.carousel-item-left)+.carousel-item+.carousel-item {
            transition: none;
        }

        .carousel-inner .carousel-item-next {
            position: relative;
            transform: translate3d(0, 0, 0);
        }

        /* left or forward direction */
        .carousel-item-next.carousel-item-left+.carousel-item+.carousel-item+.carousel-item {
            position: relative;
            transform: translate3d(-100%, 0, 0);
            visibility: visible;
        }

        /* right or prev direction */
        .carousel-item-prev.carousel-item-right+.carousel-item+.carousel-item+.carousel-item {
            position: relative;
            transform: translate3d(100%, 0, 0);
            visibility: visible;
            display: block;
            visibility: visible;
        }
    }

    /* LG */
    @media (min-width: 991px) {

        /* show 4th item */
        .carousel-inner .active+.carousel-item+.carousel-item+.carousel-item {
            display: block;
        }

        .carousel-inner .carousel-item.active:not(.carousel-item-right):not(.carousel-item-left)+.carousel-item+.carousel-item+.carousel-item {
            transition: none;
        }

        /* Show 5th slide on lg if col-lg-3 */
        .carousel-inner .active.col-lg-3.carousel-item+.carousel-item+.carousel-item+.carousel-item+.carousel-item {
            position: absolute;
            top: 0;
            right: -25%;
            /*change this with javascript in the future*/
            z-index: -1;
            display: block;
            visibility: visible;
        }

        /* left or forward direction */
        .carousel-item-next.carousel-item-left+.carousel-item+.carousel-item+.carousel-item+.carousel-item {
            position: relative;
            transform: translate3d(-100%, 0, 0);
            visibility: visible;
        }

        /* right or prev direction //t - previous slide direction last item animation fix */
        .carousel-item-prev.carousel-item-right+.carousel-item+.carousel-item+.carousel-item+.carousel-item {
            position: relative;
            transform: translate3d(100%, 0, 0);
            visibility: visible;
            display: block;
            visibility: visible;
        }
    }

</style>
@endsection

@section('javascript')
<script>
    $('#carousel-example').on('slide.bs.carousel', function (e) {
        /*
            CC 2.0 License Iatek LLC 2018 - Attribution required
        */
        var $e = $(e.relatedTarget);
        var idx = $e.index();
        var itemsPerSlide = 5;
        var totalItems = $('.carousel-item').length;

        if (idx >= totalItems - (itemsPerSlide - 1)) {
            var it = itemsPerSlide - (totalItems - idx);
            for (var i = 0; i < it; i++) {
                // append slides to end
                if (e.direction == "left") {
                    $('.carousel-item').eq(i).appendTo('.carousel-inner');
                } else {
                    $('.carousel-item').eq(0).appendTo('.carousel-inner');
                }
            }
        }
    });

</script>
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

@foreach ($data as $d)
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
@endforeach

@endif
@endsection
