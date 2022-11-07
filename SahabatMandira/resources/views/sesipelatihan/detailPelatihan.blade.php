@extends('layouts.adminlte')

@section('title')
PELATIHAN
@endsection

@section('contents')
<div style="margin:auto;">
    <div class="col-sm-6">
        <h2 class="m-0 text-dark">Detail Program Pelatihan</h2><br>
    </div>
    @foreach($data as $d)
    <div class="col-sm-8">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">{{ $d->paketProgram->kejuruan->nama }}</h3>
            </div>

            <div class="card-body">
                <h2>Balai Latihan Kerja :</h2>
                {{ $d->paketProgram->blk->nama }}
            </div>
            <div class="card-body">
                <h2>Kejuruan :</h2>
                {{ $d->paketProgram->kejuruan->nama }}
            </div>
            <div class="card-body">
                <h2>Sub Kejuruan :</h2>
                {{ $d->paketProgram->subkejuruan->nama }} {{-- karena gaada di sesi jadi ambil berdasarkan relasi --}}
            </div>
            <div class="card-body">
                <h2>Deskripsi :</h2>
                <h5>{{ $d->deskripsi}}</h5>
            </div>
            <div class="card-body">
                <h2>Periode Pendaftaran :</h2>
                <h5></h5>
            </div>
            <div class="card-footer">
                @if(Auth::user()->nomor_identitas == null)
                <a href="{{url('pelatihanPeserta/lengkapiBerkas/'.$d->id)}}"
                    class="button btn btn-warning">{{ __('DAFTAR')}}</a>
                @else
                <form method="POST" action="{{ route('pelatihanPesertas.storePendaftar',$d->id) }}">
                    @csrf
                    <input type="hidden" name="tanggal_seleksi" class="col-md-12 col-form-label"
                        value="{{ $d->tanggal_seleksi }}">

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
