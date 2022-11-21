@extends('layouts.adminlte')

@section('title')
PELATIHAN
@endsection

@section('contents')
<div style="margin:auto;">
    <div class="col-sm-12 text-center">
        <h2 class="m-0 text-dark">Detail Program Pelatihan Mentor</h2><br>
    </div>
    @foreach($data as $d)
    <div class="col-sm-8 mx-auto">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">{{ $d->nama_program }}</h3>
            </div>

            <div class="card-body">
                <h2>Nama Program Mentoring :</h2>
                <h5><b>{{ $d->nama_program }}</b></h5>
            </div>
            <div class="card-body">
                <h2>Deskripsi :</h2>
                <h5>{{ $d->deskripsi_program }}</h5>
            </div>
            <div class="card-body">
                @php
                    function tgl_indo($tanggal){
                        $bulan = array (
                            1 =>   'Januari',
                            'Februari',
                            'Maret',
                            'April',
                            'Mei',
                            'Juni',
                            'Juli',
                            'Agustus',
                            'September',
                            'Oktober',
                            'November',
                            'Desember'
                        );
                        $split = explode('-', $tanggal);
                    
                        return $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
                    }

                @endphp

                <h2>Periode Pendaftaran :</h2>
                <h5><b>{{ tgl_indo(date('Y-m-d', strtotime($d->tgl_dibuka))) }}</b> s.d
                    <b>{{ tgl_indo(date('Y-m-d', strtotime($d->tgl_ditutup))) }}</b>
                </h5>
            </div>
            <div class="card-body">
                <h2>LINK PENDAFTARAN PELATIHAN :</h2>
                <h5><a href="{{ url($d->link_pendaftaran) }}" class="btn btn-info"><i class="fa fa-paper-plane"></i> &nbsp; Link Pendaftaran</a></h5>
            </div>

        </div>
    </div>
</div>
@endforeach
@endsection