@extends('layouts.adminlte')

@section('title')
PELATIHAN
@endsection

@section('contents')
<div style="margin:auto;">
    <div class="col-sm-12 text-center">
        <h2 class="m-0 text-dark">Detail Program Pelatihan</h2><br>
    </div>
    @foreach($data as $d)
    <div class="col-sm-8 mx-auto text-justify">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">{{ $d->paketProgram->kejuruan->nama }}</h3>
            </div>

            <div class="card-body">
                <h2>Balai Latihan Kerja :</h2>
                <h5><b>{{ $d->paketProgram->blk->nama }}</b></h5>
            </div>
            <div class="card-body">
                <h2>Kejuruan :</h2>
                <h5><b>{{ $d->paketProgram->kejuruan->nama }}</b></h5>
            </div>
            <div class="card-body">
                <h2>Sub Kejuruan :</h2>
                <h5><b>{{ $d->paketProgram->subkejuruan->nama }}</b></h5> {{-- karena gaada di sesi jadi ambil berdasarkan relasi --}}
            </div>
            <div class="card-body">
                <h2>Deskripsi :</h2>
                <h5>{{ $d->deskripsi}}</h5>
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
                <h5><b>{{ tgl_indo(date('Y-m-d', strtotime($d->tanggal_pendaftaran))) }}</b> s.d
                    <b>{{ tgl_indo(date('Y-m-d', strtotime($d->tanggal_tutup))) }}</b>
                </h5>
            </div>
            <div class="card-footer">
                @if(Auth::user()->nomor_identitas == null)
                <a href="{{url('pelatihanPeserta/lengkapiBerkas/'.$d->id)}}" class="button btn btn-warning">{{ __('DAFTAR')}}</a>
                @else
                <form method="POST" action="{{ route('pelatihanPesertas.storePendaftar',$d->id) }}">
                    @csrf
                    <input type="hidden" name="tanggal_seleksi" class="col-md-12 col-form-label" value="{{ $d->tanggal_seleksi }}">

                    @if ($cekTanggalDaftarUlang != null)
                    @php
                    $tanggalHariIni = strtotime("now");
                    $tanggalTahunDepanSetelahDaftarUlang = strtotime("$cekTanggalDaftarUlang +1 year");
                    @endphp

                    @if ($tanggalHariIni >= $tanggalTahunDepanSetelahDaftarUlang)
                    @if(count($cekDaftar) == null)
                    <button type="submit" class="button btn btn-info">{{ __('DAFTAR')}}</button>
                    @else
                    <button class="button btn btn-info " disabled>{{ __('DAFTAR')}}</button>
                    @endif
                    @else
                    <button class="button btn btn-info " disabled>{{ __('DAFTAR')}}</button>
                    @endif
                    @else
                    @if(count($cekDaftar) == null)
                    <button type="submit" class="button btn btn-info">{{ __('DAFTAR')}}</button>
                    @else
                    <button class="button btn btn-info " disabled>{{ __('DAFTAR')}}</button>
                    @endif
                    @endif

                </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection