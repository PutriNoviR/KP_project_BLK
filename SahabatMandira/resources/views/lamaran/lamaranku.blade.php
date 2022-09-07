@extends('layouts.adminlte')
@section('title')
Lamaran Ku
@endsection

@section('page-bar')
<div class="w-100">
    <div class="card card-primary card-outline card-outline-tabs">
        <h1 class="m-3">Kegiatan Ku</h1>
        <div class="card-header p-0 border-bottom-0">
            <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-two-pelatihan-tab" data-toggle="pill"
                        href="#custom-tabs-two-pelatihan" role="tab" aria-controls="custom-tabs-two-pelatihan"
                        aria-selected="false">Pelatihan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-two-lamaran-tab" data-toggle="pill"
                        href="#custom-tabs-two-lamaran" role="tab" aria-controls="custom-tabs-two-lamaran"
                        aria-selected="true">Lamaran</a>
                </li>
            </ul>
        </div>
    </div>
</div>

@endsection
@section('contents')
<div class="row pb-4">
    <div class="col-4 overflow-auto">
        <div class="tab-content" id="custom-tabs-two-tabContent" style="height: 600px;">
            <div class="tab-pane fade" id="custom-tabs-two-pelatihan" role="tabpanel"
                aria-labelledby="custom-tabs-two-pelatihan-tab">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-text-width"></i>
                            Secondary Block Quotes
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body clearfix">
                        <blockquote class="quote-secondary">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.
                            </p>
                            <small>Someone famous in <cite title="Source Title">Source Title</cite></small>
                        </blockquote>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="tab-pane fade active show" id="custom-tabs-two-lamaran" role="tabpanel"
                aria-labelledby="custom-tabs-two-lamaran-tab">
                @foreach ($lamarans as $lamaran)
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body p-3">
                        <img class="mb-1" src="{{ asset('storage/'.$lamaran->lowongan->perusahaan->logo) }}"
                            style="height: 40px; width: 40px">
                        {{-- <div class="">
                            <div class="bg-primary disabled text-sm d-inline p-1 rounded">{{ $lamaran->status }}</div>
                </div> --}}
                <div class="font-weight-bolder">
                    {{ $lamaran->lowongan->nama }}
                </div>
                <div>
                    {{ $lamaran->lowongan->perusahaan->nama }}
                </div>
                <div class="font-weight-light mt-1">
                    {{ $lamaran->lowongan->perusahaan->alamat }}
                </div>
                <div class="text-sm text-muted mt-2">
                    @php
                    $date1 = strtotime($lamaran->lowongan->tanggal_pemasangan);
                    $date2 = strtotime("now");
                    $diff = abs($date2 - $date1);
                    $years = floor($diff / (365*60*60*24));
                    $months = floor(($diff - $years * 365*60*60*24)
                    / (30*60*60*24));
                    $days = floor(($diff - $years * 365*60*60*24 -
                    $months*30*60*60*24)/ (60*60*24));
                    // echo $days." hari yang lalu";
                    @endphp
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        @endforeach
    </div>
</div>
</div>
<div class="col-8">
    <div class="card h-100" id="cardDetailLamaran">
        {{-- @if ($lamaran->status == 'Tahap Seleksi')
        @elseif($lamaran->status == 'Terdaftar')
        @elseif($lamaran->status == 'Diterima')
        @elseif($lamaran->status == 'Ditolak')
        @endif --}}
        <div class="bg-lightblue disabled  rounded-top pt-3 pl-5">
            <h2 class="text-white ">Kamu sedang dalam seleksi</h2>
        </div>
    </div>
</div>
</div>
@endsection
