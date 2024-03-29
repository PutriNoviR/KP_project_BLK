@extends('layouts.adminlte')
@section('title')
Lamaran Ku
@endsection

@section('javascript')
<script>
    $('.card-lamaranku').on('click', function () {
        const idlowongan = $(this).attr('id-lowongan');

        $.ajax({
            type: 'POST',
            url: '{{ route("lamaran.getDetailLamaranCard") }}',
            data: {
                '_token': '<?php echo csrf_token() ?>',
                'lowongans_id': idlowongan,
            },
            success: function (data) {
                $("#cardDetailLamaran").html(data.msg);
            },
            error: function (xhr) {
                console.log(xhr);
            }
        });
    });

</script>
@endsection
    @section('page-bar')
    <div class="w-100">
        <div class="card card-primary card-outline card-outline-tabs">
            <h1 class="m-3 font-weight-bolder">Kegiatan Ku</h1>
            <div class="card-header p-0 border-bottom-0">
                <div class="row">
                    <div class="col-4">
                        <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                            <li class="nav-item w-50">
                                <a class="nav-link active" id="custom-tabs-two-lamaran-tab" data-toggle="pill"
                                    href="#custom-tabs-two-lamaran" role="tab" aria-controls="custom-tabs-two-lamaran"
                                    aria-selected="true">Lamaran</a>
                            </li>
                        </ul>
                    </div>
                </div>
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
                </div>
            </div>
            <div class="tab-pane fade active show" id="custom-tabs-two-lamaran" role="tabpanel"
                aria-labelledby="custom-tabs-two-lamaran-tab">
                @foreach ($lamarans as $lamaran)
                <div class="card card-lamaranku" id-lowongan="{{ $lamaran->lowongans_id }}">
                    <!-- /.card-header -->
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-between">
                            <img class="mb-1 rounded" src="{{ asset('storage/'.$lamaran->lowongan->perusahaan->logo) }}"
                                style="height: 40px; width: 40px">
                            <div class="">
                                @if ($lamaran->status == 'Tahap Seleksi')
                                <div class="bg-primary disabled text-sm d-inline p-1 rounded">
                                    <span class="">{{ $lamaran->status }}</span>
                                </div>
                                @elseif ($lamaran->status == 'Terdaftar')
                                <div class="bg-warning disabled text-sm d-inline p-1 rounded">
                                    <span class="">{{ $lamaran->status }}</span>
                                </div>
                                @elseif ($lamaran->status == 'Diterima')
                                <div class="bg-success disabled text-sm d-inline p-1 rounded">
                                    <span class="">{{ $lamaran->status }}</span>
                                </div>
                                @elseif ($lamaran->status == 'Tidak Lolos Seleksi')
                                <div class="bg-danger disabled text-sm d-inline p-1 rounded">
                                    <span class="">{{ $lamaran->status }}</span>
                                </div>
                                @endif

                            </div>
                        </div>
                        <div class="font-weight-bolder">
                            {{ $lamaran->lowongan->posisi }}
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

        </div>
    </div>
</div>
@endsection
